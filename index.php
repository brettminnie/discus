<?php
    include_once('autoPrepend.php');

    $page = new BDB\Framework\Page\HttpPage('Hello World');


    $div = new BDB\Framework\UI\Container\Form('contents', 'contents');

    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Input', 'test', 'test', 'Hello there'));
    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Password', 'test', 'test', 'Hello there'));
    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Hidden', 'test', 'test', 'Hello there'));
    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('DatePicker', 'dt_test', 'dt_test', date('d/m/Y')));
    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Submit', 'Click', 'Click', 'Moo'));
    $div->AddComponent(BDB\Framework\UI\ComponentFactory::Create('Reset', 'Click', 'Click', 'Boink'));

    $objSelect = new BDB\Framework\UI\Component\Select('Boo', 'Boo', null);
    $objSelect->AddItem('1', 'Test');
    $objSelect->AddItem('2', 'Test 2');
    $objSelect->AddItem('3', 'Test 3');


    $table = BDB\Framework\UI\ContainerFactory::Create('Table', 'moo','bah');
    $row = BDB\Framework\UI\ContainerFactory::Create('TR', 'moo','bah');
    $cell = BDB\Framework\UI\ContainerFactory::Create('TD', 'moo','bah');
    $cell->AddContents('Test');
    $row->AddComponent($cell);
    $cell = BDB\Framework\UI\ContainerFactory::Create('TD', 'moo','bah');
    $cell->AddContents('Test');
    $row->AddComponent($cell);
    $cell = BDB\Framework\UI\ContainerFactory::Create('TD', 'moo','bah');
    $cell->AddContents('Test');
    $row->AddComponent($cell);
    $table->AddComponent($row);
    $div->AddComponent($objSelect);
    $page->AddComponent($div);
    $page->AddComponent($table);
    $page->Render();
