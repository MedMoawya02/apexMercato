<?php
class Database
{
    public $servername, $username, $password, $db;

    public function __construct($servername,  $db,$username, $password)
    {
        $this->servername = $servername;
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }
    public function getConnection()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}