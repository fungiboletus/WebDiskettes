<?php
class Capture
{
	// Primary key
	public $dateID;
	public $url;

	// Rows
	public $date;
	public $hash;
	public $statusCode;
	public $isModified;
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

		groaw($http_response_header);

		groaw($this->getHeaderValue('Content-type', $http_response_header));

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

		$dataPath = $this->getDataPath(true);

		file_put_contents($dataPath, $data);
	}

	public function getDataPath($createDirs = false) {

		$firstDir = 'Data/'.substr($this->hash, 0, 2);
		$secondDir = $firstDir.'/'.substr($this->hash, 2, 4);
		$dataPath = $secondDir.'/'.substr($this->hash, 4);

		if ($createDirs) {
			if ((!is_dir($firstDir) && !mkdir($firstDir)) || (!is_dir($secondDir) && !mkdir($secondDir))) {
				throw new exception(_('Unable to create dir'));
			}
		}

		return $dataPath;
	}
}
?>
