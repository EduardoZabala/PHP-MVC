<?php

namespace Services;

use Traits\Connection;
use PDOException;

class UserService {
    use Connection;
    public function getUsers() {
        $this->openConnection();
        try {
            $statement = $this->conn->query('SELECT * FROM usuarios');
            $user = $statement->fetchAll();
            return $user;
        } catch(PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $this->closeConnection();
        }
    }


}