<?php

    namespace BDB\Framework\Page;
    
    use BDB\Framework\UI\Component;
    use BDB\Framework\Page\PageException;
    use BDB\Framework\UI\Writable;

    abstract class PageAbstract {
    	
    	protected $_headScript = array();
    	protected $_headMeta = array();
    	protected $_headCSS = array();
    	
	
    	protected $_pageTitle;
    	protected $_contentType = 'text/html';
    	protected $_contentEncoding = 'UTF-8';
    	protected $_components = array();
    	
    	protected $__hasRendered = FALSE;
    	/**
    	 * @param string $pageTitle
    	 */
    	public function __construct($pageTitle = '') {
    		$this->_pageTitle = $pageTitle;
    	}
    	
    	/**
    	 * Method to add a JS script to the document 
    	 * @param string $scriptName
    	 */
    	public function AddScript($scriptName) {
    		$this->_headScript[] = $scriptName;
    	}
    	
    	/**
    	 * Method to add multiple scripts to the document
    	 * @param array $scriptNames
    	 * @throws PageException
    	 */
    	public function AddScripts(array $scriptNames) {
    		if(!is_array($scriptNames)) {
    			throw new PageException('Expected Array got something else');
    		}
    		
    		foreach($scriptNames as $script) {
    			$this->AddScript($script);
    		}
    	}
    	
    	/**
    	 * Method to add a meta tag to the document
    	 * @param unknown_type $name
    	 * @param unknown_type $content
    	 */
    	public function AddMeta($name, $content) {
    		$this->_headMeta[$name] = $content;
    	}
    	
    	public function AddStyleSheet($cssName) {
    		$this->_headCSS[] = $cssName;
    	}
    	
    	public function AddStyleSheets(array $cssNames) {
    		if (!is_array($cssNames)) {
    			throw new PageException('Expected Array got something else');
    		}
    		
    		foreach($cssNames as $styleSheet) {
    			$this->AddStyleSheet($styleSheet);
    		}
    	}
    	
    	public function AddComponent($component) {
    		$this->_components[] = $component;
    	}
    	
    	abstract protected function RenderHead();
    	
    	abstract protected function RenderContent();
    	
    	protected function RenderComponents() {
    	    foreach($this->_components as $compontent) {
    	    	if($compontent instanceof Writable) {
    	    		$compontent->Render();
    	    	}
    	    }	
    	}
    	
    	abstract protected function RenderScripts();
    	
    	abstract  protected function RenderMeta();
    	
    	abstract protected function RenderCSS();
    	
    }

