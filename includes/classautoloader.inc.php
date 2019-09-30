<?php
//THIS FILE WILL AUTO LOAD ALL THE CLASSES GLOBALLY

spl_autoload_register('myAutoLoader');

//this will auto load the classes
function myAutoLoader($className)
{
    $path = 'classes/';
    $extention = '.class.php';
    $fullPath = $path . $className . $extention;

    include_once $fullPath;
}
