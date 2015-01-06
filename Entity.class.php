<?php
/* An Entity simply must have an id. That is all, by doing so we can 
 * perform basic crud / custom queries expecting objects that extend
 * Entity with the database class
*/
class Entity extends StdClass {
	public $id;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
}
