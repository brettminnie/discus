<?php
    include_once('autoPrepend.php');
    
    $page = new BDB\Framework\Page\HttpPage('Hello World');
    
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Input', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Password', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Hidden', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('DatePicker', 'test', 'test', date('d/m/Y')));
    
    $page->Render();
