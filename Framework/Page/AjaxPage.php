<?php

namespace BDB\Framework\Page;

use BDB\Framework\Page\PageAbstract;

class AjaxPage extends PageAbstract {
	
    public function __construct() {
    	$this->_contentType = 'application/JSON';
    	parent::__construct();
    }
    
	protected function RenderContent() {
		parent::RenderContent();
	}
	
	public function Render() {
	    $this->RenderHead();
	    $this->RenderContent();	
	}
	
	protected function RenderHead() {
		
	}
}

?>