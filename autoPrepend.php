<?php
    error_reporting(E_ALL|E_WARNING|E_NOTICE);

    ini_set('display_errors', 'on');

    use \Classes\Bootstrap;

    include_once('Classes/Bootstrap.php');

    $objBootstrap = Bootstrap::Init();

    !defined('AUTO_PREPEND_INCLUDED')|| define('AUTO_PREPEND_INCLUDED', TRUE);

    !defined('SCRIPT_PATH') || define('SCRIPT_PATH','libraries');
