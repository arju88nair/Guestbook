<?php

/**
 * Written by Nair, 30/1/19 10:04 PM
 */

/**
 * Class DBConnection for maintaining DB connection and disconnect
 */
Class DBConnection
{
    private $conn;

    /**
     * @return mysqli connection
     */
    public function  getDbConnect()
    {
        $this->conn = mysqli_connect("127.0.0.1", "root", "", "Guestbook") or die("Couldn't connect");
        return $this->conn;
    }

    /**
     * Close connection
     */
    public function closeDbConnect()
    {
        mysqli_close($this->conn) or die("There was a problem disconnecting from the database.");;
    }
}

