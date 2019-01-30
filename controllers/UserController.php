<?php

/**
 * Written by Nair, 29/1/19 8:41 PM
 */
namespace controllers;
include_once 'utils/ViewMain.php';

class UserController
{
    public static function index ()
    {
        $view = new \View('index');
        $view->assign('variablename', 'variable content');
    }
}