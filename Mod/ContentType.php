<?php
class ContentType
{
	// Primary key
	protected $id;

	// Unique columns
	public $type;

	public function __construct($type) {
		$this->type = $type;
	}

	public function getId() {
		if ($this->id === null) {
			CPDO::exec('INSERT IGNORE INTO ContentTypes (type) VALUES (:type)',
					array(':type' => $this->type));
			$this->id = CPDO::execOne('SELECT idContentTypes FROM ContentTypes WHERE (type = :type) LIMIT 1',
					array(':type' => $this->type))->idContentTypes;
		}

		return $this->id;
	}
}
?>
