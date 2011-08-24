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
		
	}
}
?>
