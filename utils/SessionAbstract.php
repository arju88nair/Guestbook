<?php

/**
 * Copyright (C) Covalense Technologies - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Nair, 30/1/19 2:36 PM
 */


abstract class SessionAbstract
{
    private $db;

    /**
     * SessionAbstract constructor. Handling construct methods like DB connection and cookie/session handling
     */
    protected function __construct()
    {
        $DbObj = new \DBConnection();
        $this->db = $DbObj->getDbConnect();
        return $this->db;

    }
}