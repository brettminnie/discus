<?php

namespace BDB\Framework\UI\Container;

use BDB\Framework\UI\Writable;
use BDB\Framework\UI\AContainer;

class Form extends AContainer {

    protected $_action = '';

    protected $_method;

    public function __construct($name, $id, $visible = TRUE, $action = '', $method = 'POST') {
        parent::__construct($name, $id, $visible);
        $this->_action = $action;
        $this->_method = $method;
    }

    public function GetMethod() {
        return $this->_method;
    }

    public function SetMethod($method) {
        $this->_method = $method;
    }

    public function GetAction() {
        return $this->_action;
    }

    public function SetAction($action) {
        $this->_action = $action;
    }

    public function Render() {
        echo "<form action='{$this->GetAction()}' method='{$this->GetMethod()}' name='{$this->GetName()}' id='{$this->GetID()}' class='{$this->GetClass()}' data-uuid='{$this->GetInternalID()}' >";

        foreach($this->_components as $item) {
            if($item instanceof Writable) {
                $item->Render();
            }
            else {
                echo $item;
            }
        }
        echo "</form>";
    }
}

