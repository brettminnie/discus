<?php

    namespace BDB\Framework\UI\Component;
    use BDB\Framework\UI\Component\Input;
    
    class Reset extends Input {
    	public function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE) {
    		parent::__construct($name, $id, $value, $visible, $enabled);
    		$this->SetType('reset');
    	}
    }

