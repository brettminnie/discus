<?php 
    
    namespace Classes;
    
    use BDB\Framework\Core\ADBO;

	class DBOQuestion extends ADBO {
    	
    	public function __construct($tableName = 'question') {
    		parent::__construct($tableName);
    	}
    	
    	public static function BuildQuestions() {
            $strQuery = self::GetBaseQuery();
    	}
    }
    