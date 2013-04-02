<?php

namespace Classes;

class Bootstrap {

    protected static $_instance;

    protected $_dbInstance;

    protected $_path;

    protected function __construct() {
        try {
            $this->_dbInstance = new \PDO('mysql:host=localhost;dbname=discus', 'root', 'r4gn4rok');
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
        $this->_path = realpath(dirname(__FILE__).'/..') . '/';
        spl_autoload_register(array($this,'Autoload'));
    }
    
    public static function Init() {
    	return self::Get();
    }
    
    public static function Get() {
        if(NULL === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function GetDbInstance() {
    	return $this->_dbInstance;
    }

    public function Autoload($className) {
        $paths = explode('\\', $className);
        $classPath = '';

        if($paths[0] == 'BDB') {
            array_shift($paths);
            $classPath = $this->_path . implode('/', $paths) . '.php';
        }
        elseif(__NAMESPACE__ == 'Classes') {
            $classPath = $this->_path . str_replace('\\','/', $className) . '.php';
        }
        
        if(file_exists($classPath)) {
            include_once($classPath);
            return TRUE;
        }
        else {
            echo "Dafuq is {$classPath}";
        }
    }


}
