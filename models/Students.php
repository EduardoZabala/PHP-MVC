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
    //Consultar no implementado

    protected function getOne($id) {
        $this->openConnection();

        try {
            $query = 'SELECT  * FROM carrera where id = :id';
            $statement = $this->conn->prepare($query);
            $statement->execute([
                ':id' => $id
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
    // Paginacion no esta implementada
    protected function getPaginated($page = 1, $filters = []){
        $resultsPerPage = 5;

        $query = "SELECT * FROM carrera";
        $queryCount = "SELECT COUNT(id) AS total_users FROM carrera";

        $initialRegister = ($page - 1) * $resultsPerPage;
        $filterValues = [];

        $filtersCount = count($filters);

        if ($filtersCount) {
            $query .= ' WHERE';

            foreach($filters as $key => $filter) {
                switch($filter['value']) {
                    case 'searcher':
                        $text = ' nombre_carrera LIKE %:search% ';
                        $query .= $text;
                        $queryCount .= $text;
                        $filterValues[':searcher'] = $filter['value'];
                        break;

                }

                if ($key < $filtersCount - 1) {
                    $query .= ' AND';
                    $queryCount .= ' AND';
                }
            }
        }

        $query .= " ORDER BY id ASC LIMIT $initialRegister, $resultsPerPage";

        try {
            $this->openConnection();

            $statement = $this->conn->prepare($query);
            $statement->execute($filterValues);

            $paginatedUsers = $statement->fetchAll();
            $statement->closeCursor();

            $statement = $this->conn->prepare($queryCount);
            $statement->execute($filterValues);

            $totalUsers = $statement->fetch()->total_users;

            return (object) [
                'status' => 200,
                'registers' => $paginatedUsers,
                'totalPages' => ceil($totalUsers / $resultsPerPage),
                'resultsPerpage' => $resultsPerPage,
                'currentPage' => $page,
            ];
        } catch (PDOException $ex){
            return (object) [
                'status' => 400,
                'error' => $ex->getMessage(),
            ];
        } finally {
            $this->closeConnection();
        }
    }
    //delete no implementado
    protected function deleteCareer($id){
        $this->openConnection();
        try {
            $query = "DELETE FROM carrera WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':id'=> $id,
                    ]
                );
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&&message=Carrera eliminada con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }  
    }
}