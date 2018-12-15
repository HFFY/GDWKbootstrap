<?php
class Database
{

    // specify your own database credentials
    private $host = "localhost";
    // private $db_name = "GDWKF";
    // private $username = "root";
    // private $password = "";
    private $db_name = "kcardenas15";
    private $username = "kcardenas15";
    private $password = "isc818";
    public $conn;

    // get the database connection
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    public function getHost()
    {
        return $this->host;
    }
    public function getDbname()
    {
        return $this->db_name;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
}
