<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

/**
 *
 * @author brett
 *        
 */
class Fieldset extends AContainer {
	
	protected $_legend;

	/**
	 * @param unknown_type $name
	 * @param unknown_type $id
	 * @param unknown_type $visible
	 */
	function __construct($name, $id, $visible = TRUE) {
		parent::__construct($name, $id, $visible);
		$this->_legend = '';
	}
	
	public function SetLegend($legend) {
		$this->_legend = $legend;
	}
	
	public function GetLegend() {
		return $this->_legend;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \BDB\Framework\UI\AContainer::Render()
	 *
	 */
	public function Render() {
		echo "<fieldset >" . PHP_EOL;
		
		if(!empty($this->GetLegend())) {
			echo "<legend>" . $this->GetLegend() . "</legend>" . PHP_EOL;
		}
		
		if(is_array($this->_components)) {
			foreach($this->_components as $item) {
				if($item instanceof Writable) {
                    $item->Render();
                }
                else {
                    echo $item;
                }
            }
        }
        echo $this->_contents;
		
		echo "</fieldset>" . PHP_EOL;
	}
}

