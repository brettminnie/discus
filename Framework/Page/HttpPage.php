<?php

namespace BDB\Framework\Page;

use BDB\Framework\Page\PageAbstract;

/**
 *
 * @author brett
 *        
 */
class HttpPage extends PageAbstract {

	/**
	 * @param string $pageTitle
	 */
	public function __construct($pageTitle = '') {
		parent::__construct($pageTitle);
		$this->AddScript('http://code.jquery.com/jquery-1.9.1.min.js');
		$this->AddScript('http://code.jquery.com/ui/1.10.1/jquery-ui.min.js');
		$this->AddStyleSheet('http://code.jquery.com/ui/1.10.1/themes/base/minified/jquery-ui.min.css');
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \BDB\Framework\Page\PageAbstract::RenderContent()
	 *
	 */
	protected function RenderContent() {
		echo "<body>".PHP_EOL;
		$this->RenderComponents();
		echo "</body>".PHP_EOL;
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \BDB\Framework\Page\PageAbstract::Render()
	 *
	 */
	public function Render() {
		$this->RenderHead();
		$this->RenderContent();
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \BDB\Framework\Page\PageAbstract::RenderHead()
	 *
	 */
	protected function RenderHead() {
		echo "<?xml version='1.0' encoding='{$this->_contentEncoding}'?>" . PHP_EOL;
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">' . PHP_EOL;
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">' . PHP_EOL;
		
		echo '<head>' . PHP_EOL;
		echo "<title>{$this->_pageTitle}</title>" . PHP_EOL;
		$this->RenderMeta();
		$this->RenderScripts();
		$this->RenderCSS();
		echo '</head>' . PHP_EOL;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \BDB\Framework\Page\PageAbstract::RenderScripts()
	 */
	protected function RenderScripts() {
		$timestamp = time();
		foreach($this->_headScript as $script) {
			echo "<script type='text/javascript' src='{$script}?{$timestamp}'></script>" . PHP_EOL;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \BDB\Framework\Page\PageAbstract::RenderMeta()
	 */
	protected function RenderMeta() {
		echo "<meta http-equiv='Content-Type' content='{$this->_contentType}' />" . PHP_EOL;
		foreach($this->_headMeta as $key=>$value) {
			echo "<meta name='{$key}' content='{$value}' />" . PHP_EOL;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \BDB\Framework\Page\PageAbstract::RenderCSS()
	 */
	protected function RenderCSS() {
		$timestamp = time();
		foreach($this->_headCSS as $script) {
			echo "<link rel='stylesheet' href='{$script}' />" . PHP_EOL;
		}
	}
}
