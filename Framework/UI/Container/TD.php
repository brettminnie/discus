<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

class TD extends AContainer {
    public function Render() {
        echo "<td name='{$this->GetName()}' id='{$this->GetID()}' class='{$this->GetClass()}' data-uuid='{$this->GetInternalID()}' >";

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
        echo "</td>";
    }
}

