<?php

namespace Services;

use Traits\Connection;
use PDOException;

class ProfessorService {
    use Connection;
    public function getProfessor() {
        $this->openConnection();
        try {
            $statement = $this->conn->query('SELECT * FROM profesor');
            $Professor = $statement->fetchAll();
            return $Professor;
        } catch(PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $this->closeConnection();
        }
    }


}