<?php

namespace BDB\Framework\Core;
namespace BDB\Framework\Interfaces;

abstract class ADBO implements Storable {
	
	protected $_tableName;

	protected $_arFields;
	
	protected $_primaryKey;

	public function __construct($tableName){
		$this->_tableName = $tableName;
		$this->_primaryKey = $tableName.'_id';
        $this->CreateFields();		
	}

	protected function CreateFields() {

	}


	public function __get($fieldName){

	}

}

