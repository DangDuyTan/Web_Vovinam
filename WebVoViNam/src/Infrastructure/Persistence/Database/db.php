<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Database;
use PDO;
use PDOException;

class DB
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "vovi_db";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connectDB();
    }

    public function connectDB()
    {
        $this->conn = null;
        try {
          $this->conn = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->dbname . "",
            $this->user,
            $this->pass
          );
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // echo "Connected successfully";
        } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

}

?>