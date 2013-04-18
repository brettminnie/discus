<?php 
    
    namespace Classes;
    
    use BDB\Framework\Core\ADBO;

	class DBOQuestionOption extends ADBO {
    	
    	public function __construct($tableName = 'question_option') {
    		parent::__construct($tableName);
    	}
  	

    }
    