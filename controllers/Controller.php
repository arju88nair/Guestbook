<?php

/**
 * Copyright (C) Covalense Technologies - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Nair, 30/1/19 2:36 PM
 */

include_once 'utils/DBConnection.php';
include_once 'utils/Database.php';

class Controller
{
    private $db;

    /**
     * Controller constructor. Handling construct methods like DB connection and cookie/session handling
     * Can add more methods
     */
    protected function __construct()
    {
        $this->_isLoggedIn();
    }

    /**
     * Checking if the login cookie is present
     */
    public function _isLoggedIn()
    {
        $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        if($_SERVER['REQUEST_METHOD'] !== "POST")
        {
            if (!isset($_COOKIE["id"]) && $request_uri[0] !== "/") {
                header("location: /");
            }
        }

    }

}