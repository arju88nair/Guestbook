<?php

/**
 * Written by Nair, 31/1/19 9:30 PM
 */


namespace controllers;


class HomeController extends \SessionAbstract
{
    private $db;
    private $conn;


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->conn = new \DBConnection();
        $this->db = $this->conn->getDbConnect();
    }


    public function index()
    {

        $approvedPosts = $this->conn->selectFreeRun("select * from posts where deleted=0 and approved=1");
        $userPosts = $this->conn->selectFreeRun("select * from posts where deleted=0  and user_id=1");
        $view = new \View('home');
        $view->assign('approvedPosts', $approvedPosts);
        $view->assign('userPosts', $userPosts);



    }

}