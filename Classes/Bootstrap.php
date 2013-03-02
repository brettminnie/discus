<?php

namespace Classes;

class Bootstrap {

    protected static $_instance = NULL;

    protected static $_dbInstance;

    protected static $_path;

    protected function __construct() {
        try {
            self::$_dbInstance = new \PDO('mysql:host=localhost;dbname=discus', 'root', 'r4gn4rok');
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
        self::$_path = realpath(dirname(__FILE__).'/..') . '/';
        spl_autoload_register(array($this,'Autoload'));
    }

    public static function Init() {
        if(NULL === self::$_instance) {
            self::$_instance == new self();
        }
        return self::$_instance;
    }

    public function Autoload($className) {
        $paths = explode('\\', $className);
        $classPath = '';

        if($paths[0] == 'BDB') {
            array_shift($paths);
            $classPath = self::$_path . implode('/', $paths) . '.php';
        }
        elseif(__NAMESPACE__ == 'Classes') {
            $classPath = self::$_path . str_replace('\\','/', $className);
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
