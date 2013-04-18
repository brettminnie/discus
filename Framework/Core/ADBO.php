<?php

namespace BDB\Framework\Core;

use BDB\Framework\Interfaces\Storable;
use Classes\Bootstrap;

abstract class ADBO implements Storable {
	
     /**
      * 
      * @var string
      */
    protected $_tableName;
	
    /**
     * 
     * @var array
     */
	protected $_arFields;
	
	/**
	 * 
	 * @var string
	 */
	protected $_primaryKey;
	
	
	/**
	 * 
	 * @var string
	 */
	protected $_aliasName;
	
	
	/**
	 * 
	 * @var array`
	 */
	protected $_constraints;
	
	/**
	 * 
	 * @var array
	 */
	protected $_joins;
	
	/**
	 * Constructor
	 * @param string $tableName
	 */
	public function __construct($tableName) {
		$this->_tableName = $tableName;
		$this->_primaryKey = $tableName . '_id';
		
		$this->CreateFields ();
		
		$this->_aliasName = str_replace(array('a','e','i','o','u','y','_','-'), '', $tableName);
		
		$this->_constraints = array();
		$this->_joins = array();
	}
	
	/**
	 * Method to generate a the fields for the table
	 */
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
	
	/**
	 * @param string $dirtyString
	 * @return string
	 */
	public static function Clean($dirtyString) {
		return Bootstrap::Get ()->GetDbInstance ()->quote ( $dirtyString );
	}
	
	/**
	 * @return string
	 */
	public function OrderByPrimaryKey() {
	    return "ORDER BY {$this->_aliasName}.{$this->_primaryKey}"; 
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \BDB\Framework\Interfaces\Storable::GetBaseQuery()
	 * @return string
	 */
	public function GetBaseQuery() {
        $strParams = "";
        foreach($this->_arFields as $field) {
            $strParams.= "{$this->_aliasName}.{$field}, ";         
        }
        $strParams = substr(trim($strParams),0,strlen(trim($strParams))-1);
        return "SELECT {$strParams} FROM {$this->_tableName} {$this->_aliasName}";
	}
	
	public function SelectByID($id) {
	}
	
	public function Store() {
	}
	
	public function AddConstraint()
	{
	}
	
	public function AddJoin()
	{
	}
	
}

