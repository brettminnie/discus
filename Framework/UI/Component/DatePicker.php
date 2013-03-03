<?php
    namespace BDB\Framework\UI\Component;

    /**
     *
     * @author Brett Minnie
     *
     */
    class DatePicker extends Input implements DHTMLInterface{
        
    	protected $_script;
        /**
         * @param string $name
         * @param string $id
         * @param mixed $value
         * @param bool $visible
         * @param bool $enabled
         */
        public function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE) {
            parent::__construct($name, $id, $value, $visible, $enabled);
            $this->ToggleReadOnly();
            $this->GenerateScripts();
        }

        /**
         * (non-PHPdoc)
         * @see BDB\Framework\UI\Component.AComponent::Render()
         */
        public function Render() {
            parent::Render();
            echo $this->_script;
        }
        
        /**
         * (non-PHPdoc)
         * @see \BDB\Framework\UI\Component\DHTMLInterface::GenerateScripts()
         */
        public function GenerateScripts() {
        	$this->_script = '<script>$(function() {$( "#' . $this->GetID() . '" ).datepicker();});</script>';
        }
        
        /**
         * (non-PHPdoc)
         * @see \BDB\Framework\UI\Component\DHTMLInterface::SetScripts()
         */
        public function SetScripts($scripts) {
        	$this->_script = $scripts;
        }
    }
