<?php

class DBConnection
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];

        $this->connection = mysqli_connect($host, $username, $password, $dbname, $port);

        if (!$this->connection) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
