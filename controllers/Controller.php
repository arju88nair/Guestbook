<?php

/**
 * Copyright (C) Covalense Technologies - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Nair, 30/1/19 2:36 PM
 */

include_once 'utils/DBConnection.php';

class Controller
{
    private $db;

    /**
     * Controller constructor. Handling construct methods like DB connection and cookie/session handling
     */
    protected function __construct()
    {
        $this->_isLoggedIn();
        $this->_dbConnection();
    }

    /**
     * Checking if the login cookie is present
     */
    public function _isLoggedIn()
    {
        $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        if (!isset($_COOKIE["id"]) && $request_uri[0] !== "/") {
            header("location: /");
        }
    }

    /**
     * Mysql DB connection
     * @return mysqli
     */
    private function _dbConnection()
    {
        $DbObj = new \DBConnection();
        $this->db = $DbObj->getDbConnect();
        return $this->db;
    }
}