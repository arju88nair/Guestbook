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
    public $sqlQuery;

    /**
     * @return mysqli connection
     */
    public function getDbConnect()
    {
        $config = parse_ini_file('config.ini');
        $this->conn = mysqli_connect($config['server'], $config['username'], $config['password'], $config['db']);
        if (!$this->conn) {
            die("Failed to connect to Database");
        }
        return $this->conn;
    }

    /**
     * Close connection
     */
    public function closeDbConnect()
    {
        mysqli_close($this->conn) or die("There was a problem disconnecting from the database.");;
    }


    /**
     * Returns the query result of a generic select query
     * @param $query
     * @return array
     */
    function selectFreeRun($query)
    {
        $result = mysqli_query($this->conn, $query);
        $this->dataSet = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($this->dataSet, $row);
            }
        }
        return $this->dataSet;
    }

    /**
     * @param $table
     * @param $field
     * @param $data
     */

    function insertData($table, $field, $data)
    {
        $field_values = implode(',', $field);
        $data_values = implode("','", $data);
        $sql = "INSERT INTO $table (" . $field_values . ") 
    VALUES ('" . $data_values . "') ";
        $result = $this->conn->query($sql);
        return $result;
    }


    /** A handy,crude method like above to handle update methods
     * @param $table
     * @param $data
     * @param $where
     * @return mixed
     */
    function updateData($table, $data, $where)
    {
        $cols = array();
        foreach ($data as $key => $val) {
            $cols[] = "$key = '$val'";
        }
        $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
        $result = $this->conn->query($sql);
        return $result;
    }
}

