<?php 

namespace app\models;

use app\config\Database;
use mysqli;

abstract class Model {

    protected $connection;
    private $database;

    public function __construct()
    {
        $this->setConnection();
    }

    public function setConnection(Database $database = new Database) {
        $this->database = $database->getMysqlConnection();
        $this->connection = new mysqli(
            $this->database->host, 
            $this->database->username,
            $this->database->password,
            $this->database->db
        );
    }

    public function getConnection() {
        return $this->connection;
    }
}