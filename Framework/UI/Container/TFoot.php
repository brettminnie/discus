<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

class TFoot extends AContainer {
    public function Render() {
        echo "<tfoot name='{$this->GetName()}' id='{$this->GetID()}' class='{$this->GetClass()}' data-uuid='{$this->GetInternalID()}' >";

        foreach($this->_components as $item) {
            if($item instanceof Writable) {
                $item->Render();
            }
            else {
                echo $item;
            }
        }
        echo "</tfoot>";
    }
}

