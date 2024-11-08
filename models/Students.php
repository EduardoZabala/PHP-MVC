<?php

namespace Models;

use PDOException;
use Traits\Connection;

class Students {

    private $id;
    private $userId;
    private $careerId;
    
    use Connection;

    protected function __construct($careerId,$userId, $id = null) {
        $this->userId = $userId;
        $this->careerId = $careerId;
        $this->id = $id;
    }

    protected function storeStudent() {
        $this->openConnection();

        try {
            $query = "INSERT INTO estudiantes (usuario_id,carrera_id) VALUES (:userId,:careerId)";
            $statement = $this->conn->prepare($query);
            $statement->execute([':userId' => $this->userId,':careerId' => $this->careerId]);
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=Estudiante registrado con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }
    }
    protected function updateStudent() {
        $this->openConnection();
        try {
            $query = "UPDATE estudiante SET carera_id=:careerId,usuario_id = :userId WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':careerId' => $this->careerId,
                        ':userId' => $this->userId,
                         ':id' => $this->id,
                    ]
            );
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=Usuario actualizado con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }
    }
    protected function ExistUser($usuario_id) {
        $this->openConnection();

        try {
            $query = 'SELECT  * FROM estudiantes where usuario_id = :usuario_id';
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