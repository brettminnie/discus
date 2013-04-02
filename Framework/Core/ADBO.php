<?php

namespace BDB\Framework\Core;

use BDB\Framework\Interfaces\Storable;
use Classes\Bootstrap;

abstract class ADBO implements Storable {
	protected $_tableName;
	protected $_arFields;
	protected $_primaryKey;
	
	public function __construct($tableName) {
		$this->_tableName = $tableName;
		$this->_primaryKey = $tableName . '_id';
		$this->CreateFields ();
	}
	
	protected function CreateFields() {
		$dbConnection = Bootstrap::Get ()->GetDbInstance ();
		
		$query = $dbConnection->prepare ( "DESCRIBE {$this->_tableName}" );
		try {
			if ($query->execute ()) {
				$tableFields = $query->fetchAll ( \PDO::FETCH_COLUMN );
				foreach ( $tableFields as $key => $val ) {
					$this->_arFields [] = $val;
				}
			} else {
				var_dump ( $dbConnection->errorInfo () );
			}
		} catch ( \Exception $e ) {
			echo $e->getMessage ();
		}
	}
	
	public function __get($fieldName) {
	}
	
	public function __set($fieldName, $value) {
	}
	
	public function __call($functionName, $params) {
	}
	
	public static function __callstatic($functionName, $params) {
	}
	
	public static function Clean($dirtyString) {
		return Bootstrap::Get ()->GetDbInstance ()->quote ( $dirtyString );
	}
	
	public static function GetBaseQuery() {
	}
	
	public function Store() {
	}
}

