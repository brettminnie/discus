<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

class TBody extends AContainer {
    public function Render() {
        echo "<tbody name='{$this->GetName()}' id='{$this->GetID()}' class='{$this->GetClass()}' data-uuid='{$this->GetInternalID()}' >";

        foreach($this->_components as $item) {
            if($item instanceof Writable) {
                $item->Render();
            }
            else {
                echo $item;
            }
        }
        echo "</tbody>";
    }
}

