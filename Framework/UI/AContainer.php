<?php

   namespace BDB\Framework\UI;
   
   use BDB\Framework\Utils\UUID;
   use BDB\Framework\UI\Writable;
   use BDB\Framework\UI\Container\ContainerException;

   abstract class AContainer implements Writable{
        
    	
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
			'className' => ''
    	);
    	
    	/**
    	 * @var string
    	 * The components uuid
    	*/
    	protected $_componentUUID;
    	
    	/**
    	 * @var mixed _contents
    	 * The contents of the container
    	 */
    	protected $_contents;

    	/**
    	 * 
    	 * @var unknown_type
    	 */
    	protected $_components;
    	
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
    	 */
    	public function __construct($name, $id, $visible = TRUE) {
    		if (! $this instanceof AContainer) {
    			throw new ContainerException ( 'Must implement AContainer' );
    		}
    		$this->SetName($name);
    		$this->SetID($id);
    		$this->_attributeArray['visible'] = $visible;
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
    			throw new ContainerException ( __CLASS__ . ': ' . __FUNCTION__ . '()trying to access a non existant property' );
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
    			throw new ContainerException ( __CLASS__ . ': ' . __FUNCTION__ . '()trying to set a non existant property ' . $key);
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
    			throw new ContainerException ( __CLASS__ . ': ' . __FUNCTION__ . 'Array expected ' . gettype ( $data ) . ' given' );
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
        
    	public function AddContents($contents) {
    		$this->_contents = $contents;
    	}
    	
    	public function AddComponent($component) {
    		$this->_components[] = $component;
    	}
    	
    	abstract public function Render();
    	
    }

