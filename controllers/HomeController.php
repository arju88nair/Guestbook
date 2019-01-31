<?php

/**
 * Written by Nair, 31/1/19 9:30 PM
 */


namespace controllers;


class HomeController extends \SessionAbstract
{
    private $db;


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $DBConnection = new \DBConnection();
        $this->db = $DBConnection->getDbConnect();
    }


    public function index()
    {
        $view = new \View('home');



    }

}