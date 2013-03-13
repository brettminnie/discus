<?php

    $test = array(
            array('Value'=>NULL, 'Data'=> array(1=>1,2=>2,3=>3), 'DisplayText'=> 'one'),
            array('Value'=>NULL, 'Data'=> array(1=>1,2=>2,3=>3), 'DisplayText'=> 'two'),
            array('Value'=>3, 'Data'=> array(1=>1,2=>2,3=>3), 'DisplayText'=> 'red'),
            array('Value'=>2, 'Data'=> array(1=>1,2=>2,3=>3), 'DisplayText'=> 'blue'),
            );
    $page = new BDB\Framework\Page\HttpPage('Hello World');


    $div = new BDB\Framework\UI\Container\Form('contents', 'contents');


    $table = BDB\Framework\UI\ContainerFactory::Create('Table', 'moo','bah');
    $row = BDB\Framework\UI\ContainerFactory::Create('TR', 'moo','bah');
    $cell = BDB\Framework\UI\ContainerFactory::Create('TD', 'moo','bah');
    $cell->AddComponent(new BDB\Framework\UI\Container\GroupedSelect('testing', 'testing', $test, 'this is a test group'));
    $row->AddComponent($cell);
    $table->AddComponent($row);
    $div->AddComponent($table);
    $page->AddComponent($div);
    $page->Render();
