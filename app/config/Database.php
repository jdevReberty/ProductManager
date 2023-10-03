<?php

namespace app\config;

class Database {

    private $mysql = [
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "db" => "dswprojeto01"
    ];

    public function getMysqlConnection() {
        return (object)$this->mysql;
    }

}
