<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\AContainer;
use BDB\Framework\UI\Component\Select;
use BDB\Framework\UI\Container\Fieldset;
use BDB\Framework\UI\Writable;

/**
 *
 * @author brett
 *        
 */
class GroupedSelect extends AContainer {
	// TODO - Insert your code here
	
	public function __construct($name, $id, array $valueSets, $questionHeading = '') {
	    parent::__construct("{$name}_group", "{$id}_group");
	    $container = new Fieldset($name, $id);
	    $container->SetLegend($questionHeading);
	    $current = 1; 
	    foreach($valueSets as $set) {
	    	$value = isset($set['Value'])?$set['Value']:null;
		$label = new \BDB\Framework\UI\Component\Label
	    	$container->AddComponent(new Select("{$name}_{$current}", "{$id}_{$current}", $value , TRUE, TRUE, $set['Data']));
	    	$current++;
	    }
	    $this->AddComponent($container);    	
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \BDB\Framework\UI\AContainer::Render()
	 *
	 */
	public function Render() {
		
	foreach($this->_components as $item) {
		if($item instanceof Writable) {
			$item->Render();
		}
        else {
        	echo $item;
        }
	}
	}
	
}

