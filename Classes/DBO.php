<?php

namespace Classes;

abstract class DBO {
	protected $_tableName;

	protected $_arFields;

	public function __construct($tableName){
		$this->_tableName = $tableName;
		$this->_arFields = array();
	}

	protected function _createFields(){

	}


	public function __get($fieldName){

		$objReflectionClass = new \ReflectionClass(__CLASS__);
		$arProperties = $objReflectionClass->getProperties();

		foreach($arProperties as $property) {
			echo $property->getName();
		}
	}

}

?>