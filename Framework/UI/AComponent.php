<?php

namespace BDB\Framework\UI;

use BDB\Framework\Utils\UUID;
use BDB\Framework\UI\Writable;
use BDB\Framework\UI\Component\ComponentException;

abstract class AComponent implements Writable{
    /**
     * @var Array
     * Array containing the base attributes
     * @todo Make this automagic so that each of these are relevant attributes on
     * the component an populate on render if not = NULL
     */
    protected $_attributeArray = array (
            'componentId' => '',
            'componentName' => '',
            'visible' => TRUE,
            'enabled' => TRUE,
            'value' => '',
            'className' => '',
            'readonly' => FALSE
    );

    /**
     * @var string
     * The components uuid
    */
    protected $_componentUUID;

    /**
     * @var Array
     * Array containing elements that will be output as JQuery Data
     */
    protected $_jquery_data;

    /**
     * Default constructor
     * @var string $name the name of the componenent
     * @var string id the dom id of the component
     * @var bool visible is the component to be displayed
     * @var enabled is the component interactive
     */
    public function __construct($name, $id, $value, $visible = TRUE, $enabled = TRUE) {
        if (! $this instanceof AComponent) {
            throw new ComponentException ( 'Must implement AComponent' );
        }
        $this->SetName($name);
        $this->SetID($id);
        $this->SetValue($value);
        $this->_attributeArray['visible'] = $visible;
        $this->_attributeArray['enabled'] = $enabled;
        $this->_jquery_data = array ();
        $this->_componentUUID = UUID::GenUUID();
    }

    /**
     * Accessors *
     */

    /**
     * Magic getter that will return the values contained in the array _attributeArray
     * @var string $key the name of the attribute we are accessing
     * @returns mixed the value of the key if set
     * @throws ComponentException
    */
    public function __get($key) {
        if (array_key_exists ( $key, $this->_attributeArray )) {
            return $this->_attributeArray [$key];
        } else {
            throw new ComponentException ( __CLASS__ . ': ' . __FUNCTION__ . '()trying to access a non existant property' );
        }
    }

    /**
     * Magic setter that will set the values contained in the array _attributeArray
     * @var string $key the name of the attribute we are accessing
     * @var string $value the value you want to set it to
     * @returns mixed the value of the key if set
     * @throws ComponentException
    */
    public function __set($key, $value) {
        if (array_key_exists ( $key, $this->_attributeArray )) {
            $this->_attributeArray [$key] = $value;
        } else {
            throw new ComponentException ( __CLASS__ . ': ' . __FUNCTION__ . '()trying to set a non existant property ' . $key);
        }
    }

    /**
     * Accessor to set the name of the object
     * @var string $name the name value we are setting the component to
    */
    public function SetName($name) {
        $this->_attributeArray ['componentName'] = $name;
    }

    /**
     * Accessor to get the components DOM name
     * @return string
    */
    public function GetName() {
        return $this->_attributeArray ['componentName'];
    }

    /**
     * Function to set the DOM id of the component
     * @var string $id
    */
    public function SetID($id) {
        $this->_attributeArray ['componentId'] = $id;
    }

    /**
     * Function to get the DOM id of the component
     * @return string
    */
    public function GetID() {
        return $this->_attributeArray ['componentId'];
    }

    /**
     * Function to get the internal component ID, this is only really for internal use
     * @return string
    */
    public function GetInternalID() {
        return $this->_componentUUID;
    }

    /**
     * Function to set an internal JQuery style Data element
     * @var string $key The name value of the attribute
     * @var string $value The value we are setting this to
    */
    public function AddData($key, $value) {
        $this->_jquery_data [$key] = $value;
    }

    /**
     * Function to add a real whole bunch of JQuery data elements
     * @var array $data a set of $key->$val elements
     * @throws ComponentException
    */
    public function AddDataArray(array $data) {
        if (is_array ( $data )) {
            foreach ( $data as $key => $value ) {
                $this->AddData ( $key, $value );
            }
        } else {
            throw new ComponentException ( __CLASS__ . ': ' . __FUNCTION__ . 'Array expected ' . gettype ( $data ) . ' given' );
        }
    }

    /**
     * Function to check if a JQuery element exists
     * @var string $elementName
    */
    public function DataElementExists($elementName) {
        return(array_key_exists($elementName, $this->_jquery_data));
    }

    /**
     * Function to set the base classname
     * @var string $className
    */
    public function SetClass($className) {
        $this->_attributeArray ['className'] = $className;
    }

    /**
     * Function to append the classname
     * @var string $className
    */
    public function AppendClass($className) {
        $this->_attributeArray ['className'] .= ' ' . trim ( $className );
    }

    /**
     * Function to prepend the base classname
     * @var string $className
    */
    public function PrependClass($className) {
        $this->_attributeArray ['className'] = trim ( $className ) . ' ' . trim ( $this->_attributeArray ['className'] );
    }

    /**
     * Function to get the base classname
     * @return string $className
    */
    public function GetClass() {
        return $this->_attributeArray ['className'];
    }

    /**
     * Method to toggle the disabled flag default off
    */
    public function ToggleEnable() {
        $this->_attributeArray['enabled'] = !$this->_attributeArray['enabled'];
    }

    /**
     * Method to return the disabled dom string or ''
     * @return string
     * */
    public function IsEnabled() {
        return ($this->_attributeArray['enabled'])?'':"disabled='disabled'";
    }

    public function ToggleVisible() {
        $this->_attributeArray['visible'] = !$this->_attributeArray['visible'];
    }

    public function IsVisible() {
        return (FALSE === $this->_attributeArray['visible'])?"style='display:none;'":'';
    }

    public function ToggleReadOnly() {
        $this->_attributeArray['readonly'] = !$this->_attributeArray['readonly'];
    }

    public function IsReadOnly() {
        return (FALSE === $this->_attributeArray['readonly'])?'':"readonly='readonly'";
    }

    public function SetValue($value) {
        $this->_attributeArray['value'] = $value;
    }

    public function GetValue() {
        return $this->value;
    }

    public function GetJQueryAttributes() {
        $jquerydata = '';
        foreach($this->_jquery_data as $key=>$value) {
            $jquerydata.= "{$key}='{$value}' ";
        }
        return trim($jquerydata);
    }

    abstract public function Render();
}
