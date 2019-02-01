<?php

/**
 * Written by Nair, 30/1/19 10:04 PM
 */

/**
 * Class DBConnection for maintaining DB connection and disconnect
 */
Class DBConnection
{
    public $conn;
    public $dataSet;

    /**
     * @return mysqli connection
     */
    public function getDbConnect()
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

    function selectFreeRun($query)
    {

        $result = mysqli_query($this->conn, $query);
        $this->dataSet = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($this->dataSet, $row);
            }
        } else {
            echo "0 results";
        }
        return $this->dataSet;

    }
}

