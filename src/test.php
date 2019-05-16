<?php
require_once 'Parser.php';
$parser = new Parser();
echo "<pre>";
var_dump($parser->process('https://yiiframework.com.ua/ru/doc/guide/2/structure-views/', 'a'));
echo "</pre>";