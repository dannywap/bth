<?php
/**
* A model for automatic menu.
*
* @package LydiaCore
*/
class CMMenu extends CObject implements IHasSQL {

  /**
* Properties
*/
  


  /**
* Constructor
*/
  public function __construct($ly=null) {
    parent::__construct($ly);
  }

	  /**
	* Implementing interface IHasSQL. Encapsulate all SQL used by this class.
	*
	* @param string $key the string that is the key of the wanted SQL-entry in the array.
	*/

	public static function SQL($key=null) {
		$queries = array(
			// 'check if table setup' => "SELECT COUNT(*) as col1 FROM information_schema.tables WHERE table_name = 'Content';",
			'select all keys where pages' => "SELECT `key` FROM Content WHERE TYPE = 'page';",
		);
		if(!isset($queries[$key])) {
			throw new Exception("No such SQL query, key '$key' was not found.");
		}
		return $queries[$key];
	}
  
  	/**
	* List pages.
	*
	* @returns array with pages.
	*/
	public function list_pages() {
		try {
			return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select all keys where pages'));
		} catch(Exception $e) {
			echo $e;
			return null;
		}
	}
	
  	/**
	* Check_for_table.
	*
	* @returns array with number of hits.
	*/
	// - DO NOT USE! My webhost disabled my site due to enourmus amount of duplicates of this sql-query:
	// public function check_for_table() {
		// try {
			// return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('check if table setup'));
		// } catch(Exception $e) {
			// echo $e;
			// return null;
		// }
	// }  	
	
	
}
?>