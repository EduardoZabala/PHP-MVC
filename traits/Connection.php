<?php

namespace Traits;

use PDO;

trait Connection {
    private $dsn;
    private $user;
    private $password;
    protected $conn;

    protected function openConnection() {
        try {
            $this->dsn = "mysql:host=localhost;dbname=universidad";
            $this->user = 'root';
            $this->password = '';

            $this->conn = new PDO($this->dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch(\Exception $e) {
            echo ($e->getMessage());
        }
    }

    protected function closeConnection() {
        $this->conn = null;
    }
}