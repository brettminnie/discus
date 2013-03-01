<?php
    namespace BDB\Framework\UI\Component;

    /**
     *
     * @author Brett Minnie
     *
     */
    class DatePicker extends Input {

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
        }

        /**
         * (non-PHPdoc)
         * @see BDB\Framework\UI\Component.AComponent::Render()
         */
        public function Render() {
            parent::Render();
        }
    }
