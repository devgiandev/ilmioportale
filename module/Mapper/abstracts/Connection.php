<?php

namespace Mapper;

use PDO;

abstract class Connection
{
    private $config;
    private $conn;

    public function __construct($config)
    {
        $this->config = $config;
        $dbHost = $this->config['db']['host'];
        $dbName = $this->config['db']['name'];
        $dbUsername = $this->config['db']['username'];
        $dbPassword = $this->config['db']['password'];
        $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }



}