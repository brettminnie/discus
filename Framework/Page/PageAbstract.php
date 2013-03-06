<?php

    namespace BDB\Framework\Page;
    
    use BDB\Framework\UI\Component;
    use BDB\Framework\Page\PageException;
    use BDB\Framework\UI\Writable;

    abstract class PageAbstract {
    	
    	/**
    	 * @var array containing all the javascript includes for the page
    	 */
    	protected $_headScript = array();
    	
    	/**
    	 * @var array containing any meta tags in the page
    	 */
    	protected $_headMeta = array();
    	
    	/**
    	 * @var array containing all the css includes for the page
    	 */
    	protected $_headCSS = array();
    	
        /**
         * @var string for the <title> tag
         */	
    	protected $_pageTitle;
    	
    	/**
    	 * @var string containing the content type to set in the meta headers
    	 */
    	protected $_contentType = 'text/html';
    	
    	/**
    	 * @var string containing the content type of the page
    	 */
    	protected $_contentEncoding = 'UTF-8';
    	
    	/**
    	 * @var an array of BDB\Framework\UI\Writable components 
    	 */
    	protected $_components = array();
    	
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
    	
    	/**
    	 * Method to add a single stylesheet the document
    	 * @param string $cssName
    	 */
    	public function AddStyleSheet($cssName) {
    		$this->_headCSS[] = $cssName;
    	}
    	
    	/**
    	 * Method to add multiple stylesheets to the document
    	 * @param array $cssNames
    	 * @throws PageException
    	 */
    	public function AddStyleSheets(array $cssNames) {
    		if (!is_array($cssNames)) {
    			throw new PageException('Expected Array got something else');
    		}
    		
    		foreach($cssNames as $styleSheet) {
    			$this->AddStyleSheet($styleSheet);
    		}
    	}
    	
    	/**
    	 * Method to add a BDB\Framework\UI\Writable component to the document body
    	 * @param BDB\Framework\UI\Writable $component
    	 */
    	public function AddComponent(Writable $component) {
    		$this->_components[] = $component;
    	}

    	/**
    	 * Method to add multiple components to the document body
    	 * @param array $components
    	 * @throws PageException
    	 */
    	public function AddComponents(array $components) {
    		if(!is_array($components)) {
    			throw new PageException('Expected an array of components');
    		}
    		
    		foreach($components as $item) {
    			if($item instanceof Writable) {
    			    $this->AddComponent($item);
    			}
    		}
    	}
    	
    	/**
    	 * Abstract method to render the <head> content
    	 */
    	abstract protected function RenderHead();
    	
    	/**
    	 * Abstract method to render the <body> content
    	 */
    	abstract protected function RenderContent();
    	
    	/**
    	 * Method to render all the internal components
    	 */
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
    	
    	protected function GetMethod() {
    		return $_SERVER[REQUEST_METHOD];
    	}
    	
    	protected function IsAjax() {
    		return ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'));
    	}
    }

