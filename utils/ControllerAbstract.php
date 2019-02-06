<?php
/**
 * Written by Nair
 */

include_once 'DBConnection.php';

abstract class ControllerAbstract
{
    protected $db;
    protected $conn;
    protected $userId;

    /**
     * Controller constructor. Handling construct methods like DB connection and cookie/session handling
     * Can add more methods
     */
    protected function __construct()
    {
        $this->_isLoggedIn();
        $this->_doDbConnection();
        // Can do more process here
    }


    /**
     * Checking if the login cookie is present
     */
    protected function _isLoggedIn()
    {
        $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            if (!isset($_COOKIE["id"]) && $request_uri[0] !== "/") {
                header("location: /");
            }
        }
    }

    /**
     * Making DB connection
     */
    protected function _doDbConnection()
    {
        $this->conn = new \DBConnection();
        $this->db = $this->conn->getDbConnect();
    }


}