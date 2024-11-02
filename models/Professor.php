<?php

namespace Models;

use PDOException;
use Traits\Connection;

class Professor {
    private $id;
    private $userId;
    
    use Connection;

    protected function __construct($userId, $id = null) {
        $this->userId = $userId;
        $this->id = $id;
    }

    protected function storeProfessor() {
        $this->openConnection();

        try {
            $query = "INSERT INTO profesor (usuario_id) VALUES (:userId)";
            $statement = $this->conn->prepare($query);
            $statement->execute([':userId' => $this->userId]);
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=Profesor registrado con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }
    }
    protected function updateProfessor() {
        $this->openConnection();
        try {
            $query = "UPDATE profesor SET usuario_id = :userId WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':userId' => $this->userId,
                         ':id' => $this->id,
                    ]
            );
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=Profesor actualizado con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }
    }

    protected function ExistUser($usuario_id) {
        $this->openConnection();

        try {
            $query = 'SELECT  * FROM profesor where usuario_id = :usuario_id';
            $statement = $this->conn->prepare($query);
            $statement->execute([
                ':usuario_id' => $usuario_id
            ]);
            if($statement->rowCount()) {
                return (object)[
                    'status'=> 200,
                    'success' => true,
                    'user'=> $statement->fetch(),
                ];
            }
            return (object)[
                'status'=> 200,
                'success' => false,
            ];
        } catch(PDOException $ex) {
            return (object)[
                'status'=> 400,
                'error'=> $ex->getMessage()
            ];
        } finally {
            $this->closeConnection();
        }
        
    }
}