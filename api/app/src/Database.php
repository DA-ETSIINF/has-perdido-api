<?php
namespace App\Acme;

use PDO;

class Database
{
    // specify your own database credentials
    private $host = "mysql";
    private $db_name = "hasperdidodb";
    private $db_port = "3306";
    public $conn;
    private $username = "dev";
    private $password = "dev";

    // get the database connection
    public function getConnection()
    {
        $pdo = null;
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8;port=' . $this->db_port;
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Database conexion error: " . $exception->getMessage();
        }
        return $pdo;
    }
}