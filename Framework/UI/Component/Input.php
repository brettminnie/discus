<?php
    namespace BDB\Framework\UI\Component;

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
        public function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE) {
            parent::__construct($name, $id, $value, $visible, $enabled);
        }

        /**
         * (non-PHPdoc)
         * @see BDB\Framework\UI\Component.AComponent::Render()
         */
        public function Render() {
            echo "
            <input
                type='text'
                name='{$this->GetName()}'
                id='{$this->GetID()}'
                class='{$this->GetClass()}'
                data-uuid='{$this->GetInternalID()}'
                value='{$this->GetValue()}'
                {$this->IsEnabled()} {$this->IsReadOnly()} {$this->IsVisible()}
            />" . PHP_EOL ;
        }
    }
