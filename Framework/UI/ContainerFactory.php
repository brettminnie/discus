<?php

namespace BDB\Framework\UI;


class ContainerFactory {

    const COMP_PATH = 'Framework/UI/Container';
    const COMP_NS   = 'BDB\\Framework\\UI\\Container\\';

    protected static $_instance = NULL;
    protected static $_objectArray;

    protected function __construct() {
        $path = realpath(getcwd().'/'.self::COMP_PATH);

        $dirHwnd = opendir($path);

        while(false != ($file = readdir($dirHwnd))) {
            if(strstr($file, '.php') && $file != 'AContainer.php' && $file != 'ContainerException.php') {
                self::$_objectArray[] = substr($file, 0, strlen($file)-4);
            }
        }
        closedir($dirHwnd);
    }

    public static function Create($component, $name, $id, $visible = TRUE) {

        if(self::$_instance == NULL) {
            self::$_instance = new self();
        }

        if(in_array($component, self::$_objectArray)) {
            $class = self::COMP_NS. $component;
            return new $class($name, $id, $visible);
        }
        else {
            $exception = self::COMP_NS .'ContainerException';
            throw new $exception("Component {$component} not found");
        }
    }
}

