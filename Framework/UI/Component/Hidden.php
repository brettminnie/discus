<?php
    namespace BDB\Framework\UI\Component;

    use BDB\Framework\UI\AComponent;
    /**
     *
     * @author Brett Minnie
     *
     */
    class Hidden extends AComponent {

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
                type='hidden'
                name='{$this->GetName()}'
                id='{$this->GetID()}'
                class='{$this->GetClass()}'
                data-uuid='{$this->GetInternalID()}'
                value='{$this->GetValue()}'
                {$this->IsEnabled()} {$this->IsReadOnly()} {$this->IsVisible()} {$this->GetJQueryAttributes()}
            />" . PHP_EOL ;
        }
    }
