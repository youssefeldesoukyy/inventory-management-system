<?php

namespace App;

use mysqli;
class DB
{
    private string $hostname = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "ia_section_2025";
    public mysqli $Connection;

    public function __construct()
    {
        $this->Connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    public function checkConnection()
    {
        if ($this->Connection->connect_error == null)
            echo "Connected To Database";
        else
            echo "Not Connected To Database";
    }
}