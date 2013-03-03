<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

class Div extends AContainer {
	
	public function Render() {
		echo '<div>';
		if($this->_contents instanceof Writable) {
			$this->_contents->Render();
		}
        else {
        	echo $this->_contents;
        }		
		echo '</div>';
	}
}
