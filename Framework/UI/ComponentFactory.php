<?php

namespace BDB\Framework\UI;

class ComponentFactory {

    const COMP_PATH = 'Framework/UI/Component';
    const COMP_NS   = 'BDB\\Framework\\UI\\Component\\';

    protected static $_instance = NULL;
    protected static $_objectArray;

    protected function __construct() {
        chdir(self::COMP_PATH);
        $path = getcwd();

        $dirHwnd = opendir($path);

        while(false != ($file = readdir($dirHwnd))) {
            if(strstr($file, '.php') && $file != 'AComponent.php' && $file != 'ComponentException.php') {
                self::$_objectArray[] = substr($file, 0, strlen($file)-4);
            }
        }
        closedir($dirHwnd);
    }

    public static function Create($component, $name, $id, $value, $visible = TRUE, $enabled = TRUE) {

        if(self::$_instance == NULL) {
            self::$_instance = new self();
        }

        if(in_array($component, self::$_objectArray)) {
            $class = self::COMP_NS. $component;
            return new $class($name, $id, $value, $visible, $enabled);
        }
        else {
            $exception = self::COMP_NS .'ComponentException';
            throw new $exception("Component {$component} not found");
        }
    }
}

