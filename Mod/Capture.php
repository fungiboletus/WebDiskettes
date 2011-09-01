<?php
class Capture
{
	// Primary key
	public $dateID;
	public $url;

	// Columns
	public $date;
	public $hash;
	public $statusCode;
	public $size;
	public $contentType;

	// Local members
	public $data;

	public function __construct($dateID, $url) {
		$this->dateID = $dateID;

		if (strncasecmp($url, 'http://', 7) !== 0) {
			$url = "http://$url";
		}

		$this->url = $url;
	}

	public function download() {

		$this->data = file_get_contents($this->url, false, null, -1, MAX_FILESIZE);

		$this->date = time();

		// the hash is calculated after

		$httpLine = $http_response_header[0];

		$matchs;
		preg_match('/.+([0-9]{3}).*/', $httpLine, $matchs);
	
		// if the header code is unknown, we think that it's 200
		if (count($matchs) > 0) {
			$this->statusCode = (int) $matchs[1];
		} else {
			$this->statusCode = 200;
		}

		$this->size = strlen($this->data);

		$this->contentType = $this->getHeaderValue('Content-type', $http_response_header);

	}

	private function getHeaderValue($key, $http_response_header) {
		$l = strlen($key);

		foreach ($http_response_header as $line) {
			if (strncasecmp($key, $line, $l) === 0) {
				return trim(substr($line, $l+2));
			}
		}

		return null;
	}

	public function loadFromCache() {
		groaw($this->getDataPath());	
	}

	public function save() {

		// Compress value
		if (USE_GZIP_COMPRESSION) {
			$this->data = gzcompress($this->data, 9);
		}

		$this->hash = sha1($this->data.'WebDiskettes');

		$dataPath = $this->getDataPath(true);

		if (!file_exists($dataPath) && !file_put_contents($dataPath, $this->data)) {
			throw new exception(_('Unable to write capture save'));	
		}

		$oUrl = new URL($this->url);
		$oContentType = new ContentType($this->contentType);

		$idUrl = $oUrl->getId();
		$idContentType = $oContentType->getId();

		CPDO::exec('INSERT INTO Captures (dateID, URLs_idURLs, date, hash, statusCode, size, ContentTypes_idContentTypes) VALUES (:dateID, :URLs_idURLs, :date, UNHEX(:hash), :statusCode, :size, :ContentTypes_idContentTypes)', array(
				':dateID' => $this->dateID,
				':URLs_idURLs' => $idUrl,
				':date' => $this->date,
				':hash' => $this->hash,
				':statusCode' => $this->statusCode,
				':size' => $this->size,
				':ContentTypes_idContentTypes' => $idContentType
			));
	}

	public function getDataPath($createDirs = false) {

		$firstDir = 'Data/'.substr($this->hash, 0, 2);
		$secondDir = $firstDir.'/'.substr($this->hash, 2, 2);
		$dataPath = $secondDir.'/'.substr($this->hash, 4);

		if ($createDirs) {
			if ((!is_dir($firstDir) && !(mkdir($firstDir)&&touch("$firstDir/index.html"))) || (!is_dir($secondDir) && !(mkdir($secondDir)&&touch("$secondDir/index.html")))) {
				throw new exception(_('Unable to create dir'));
			}
		}

		return $dataPath;
	}

	public static function getAll() {
		return CPDO::exec('SELECT dateID, url, date, HEX(hash) as hash, statusCode, size, type
FROM Captures, ContentTypes, URLs
WHERE idURLS = URLs_idURLs AND idContentTypes = ContentTypes_idContentTypes');
	}
}
?>
