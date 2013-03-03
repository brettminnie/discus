<?php
    include_once('autoPrepend.php');
    
    $page = new BDB\Framework\Page\HttpPage('Hello World');
    
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Input', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Password', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Hidden', 'test', 'test', 'Hello there'));
    $page->AddComponent(BDB\Framework\UI\ComponentFactory::Create('DatePicker', 'dt_test', 'dt_test', date('d/m/Y')));
    
    $objSelect = new BDB\Framework\UI\Component\Select('Boo', 'Boo', null);
    $objSelect->AddItem('1', 'Test');
    $objSelect->AddItem('2', 'Test 2');
    $objSelect->AddItem('3', 'Test 3');
    
    $page->AddComponent($objSelect);
    $page->Render();
