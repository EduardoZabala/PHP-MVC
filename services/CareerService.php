<?php

namespace Services;

use Traits\Connection;
use PDOException;

class CareerService {
    use Connection;
    public function getCarrers() {
        $this->openConnection();
        try {
            $statement = $this->conn->query('SELECT * FROM carrera');
            $career = $statement->fetchAll();
            return $career;
        } catch(PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $this->closeConnection();
        }
    }


}