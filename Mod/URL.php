<?php
class URL
{
	// Primary key
	protected $id;

	// Unique columns
	public $url;

	public function __construct($url) {
		$this->url = $url;
	}

	public function getId() {
		if ($this->id === null) {
			CPDO::exec('INSERT IGNORE INTO URLs (url) VALUES (:url)',
					array(':url' => $this->url));
			$this->id = CPDO::exec('SELECT idURLs FROM URLs WHERE (url = :url) LIMIT 1',
					array(':url' => $this->url))->idURLs;
		}

		return $this->id;
	}
}
?>
