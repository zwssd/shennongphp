<?php

class bbbController
{

    public function __construct()
    {
        echo 'aaabbbController ok!!!';
    }

    public function index()
    {
        echo 'aaabbbController   index() ok!!!';
    }

    public function test()
    {
        echo 'aaabbbController   test() ok!!!';

        //require_once 'system/lib/template/Twig/Autoloader.php';
        var_dump($load);
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Array(array(
            'index' => 'Hello {{ name }}!',
        ));
        $twig = new Twig_Environment($loader);
        echo $twig->render('index', array('name' => 'Fabien'));
        exit;
    }
}
