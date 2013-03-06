<?php
    namespace BDB\Framework\UI\Component;

    use BDB\Framework\UI\AComponent;
    /**
     *
     * @author Brett Minnie
     *
     */
    class Input extends AComponent {

        /**
         * @param string $name
         * @param string $id
         * @param mixed $value
         * @param bool $visible
         * @param bool $enabled
         */
    	protected $_type = 'text';
    	
    	
        public function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE) {
            parent::__construct($name, $id, $value, $visible, $enabled);
        }

        public function SetType($type) {
        	$this->_type = $type;
        }
        /**
         * (non-PHPdoc)
         * @see BDB\Framework\UI\Component.AComponent::Render()
         */
        public function Render() {
            echo "
            <input
                type='{$this->_type}'
                name='{$this->GetName()}'
                id='{$this->GetID()}'
                class='{$this->GetClass()}'
                data-uuid='{$this->GetInternalID()}'
                value='{$this->GetValue()}'
                {$this->IsEnabled()} {$this->IsReadOnly()} {$this->IsVisible()} {$this->GetJQueryAttributes()}
            />" . PHP_EOL ;
        }
    }
