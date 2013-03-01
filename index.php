<?php
    include_once('autoPrepend.php');

    BDB\Framework\UI\ComponentFactory::Create('Input', 'test', 'test', 'Hello there')->Render();
    BDB\Framework\UI\ComponentFactory::Create('Password', 'test', 'test', 'Hello there')->Render();
    BDB\Framework\UI\ComponentFactory::Create('Hidden', 'test', 'test', 'Hello there')->Render();
    BDB\Framework\UI\ComponentFactory::Create('DatePicker', 'test', 'test', date('d/m/Y'))->Render();
