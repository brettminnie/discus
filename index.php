<?php
    include_once('autoPrepend.php');

    $o = BDB\Framework\UI\ComponentFactory::Create('Input', 'test', 'test', 'Hello there');
    $o->Render();
