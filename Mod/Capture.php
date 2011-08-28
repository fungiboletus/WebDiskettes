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
		$this->url = $url;
	}

	public function load() {
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
