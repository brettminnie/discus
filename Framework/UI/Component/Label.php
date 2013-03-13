<?php

namespace BDB\Framework\UI\Component;

require_once ('Framework/UI/Component/AComponent.php');

use BDB\Framework\UI\AComponent;

class Label extends AComponent {

    protected $_for = '';


    public function SetFor($for) {
        $this->_for = $for;
    }

    public function GetFor() {
        return $this->_for;
    }
    /* (non-PHPdoc)
     * @see \BDB\Framework\UI\AComponent::Render()
     */
    public function Render() {
        echo "<label for='{$this->GetFor()}' id='{$this->GetID()}' data-uuid='{$this->GetInternalID()}' class='{$this->GetClass()}' name='{$this->GetName()}'>{$this->GetValue()}</label>" . PHP_EOL;
    }

}

