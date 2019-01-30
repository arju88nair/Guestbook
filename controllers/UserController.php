<?php

/**
 * Written by Nair, 29/1/19 8:41 PM
 */

namespace controllers;
include_once 'utils/ViewMain.php';
include_once 'utils/SessionAbstract.php';

class UserController extends \SessionAbstract
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view = new \View('index');
        $view->assign('variablename', 'variable content');
    }
}