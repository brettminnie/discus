<?php

    namespace BDB\Framework\UI\Component;
    
    use BDB\Framework\UI\AComponent;
    
    class Select extends AComponent {
    	
    	protected $_elements;
    	protected $_includeNone = TRUE;
    	
    	protected $_noneText = "Please Choose";
    	
    	/**
    	 * 
    	 * @param unknown_type $name
    	 * @param unknown_type $id
    	 * @param unknown_type $value
    	 * @param unknown_type $visible
    	 * @param unknown_type $enabled
    	 * @param unknown_type $elements
    	 */
    	function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE, $elements = array()) {
    		parent::__construct($name, $id, $value, $visible, $enabled);
    		$this->_elements = $elements;

    	}
    	
    	/**
    	 * 
    	 * @param unknown_type $bToggle
    	 */
    	public function SetDisplayNone($bToggle = TRUE) {
    		$this->_includeNone = $bToggle;
    	}
    	
    	
    	/**
    	 * 
    	 * @param unknown_type $text
    	 */
    	public function SetNoneText($text = 'Please Choose'){
    		$this->_noneText = $text;
    	}
    	
    	/**
    	 * @param mixed $value
    	 * @param mixed $displayText
    	 */
    	public function AddItem($value, $displayText) {
    		$this->_elements[$value] = $displayText;
    	}
    	
    	/**
    	 * @param array $items
    	 */
    	public function AddItems(array $items) {
    		foreach($items as $value=>$displayText) {
    			$this->AddItem($value, $displayText);
    		}
    	}
    	
    	/**
    	 * (non-PHPdoc)
    	 * @see \BDB\Framework\UI\Component\AComponent::Render()
    	 */
    	public function Render() {
    		echo "<select  name='{$this->GetName()}' id='{$this->GetID()}' class='{$this->GetClass()}' data-uuid='{$this->GetInternalID()}' {$this->IsEnabled()} {$this->IsReadOnly()} {$this->IsVisible()} {$this->GetJQueryAttributes()}>" . PHP_EOL ;
    		if($this->_includeNone) {
    			echo "<option value=''>{$this->_noneText}</option>";
    		}
    		
    		foreach($this->_elements as $value=>$displayText) {
    			$selected = (($this->GetValue() === $value)?"selected='selected'":'');
    			echo "<option value='{$value}' {$selected}>{$displayText}</option>";
    		}
    		echo "</select>";
    	}
    }

