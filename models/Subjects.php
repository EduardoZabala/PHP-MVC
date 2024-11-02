<?php

namespace Models;

use PDOException;
use Traits\Connection;

class Subjects {

    private $id;
    private $name;
    private $StudentsCapacity;
    private $id_professor;


    use Connection;

    protected function __construct($name, $StudentsCapacity, $id_professor, $id = null) {
        $this->name = $name;
        $this->StudentsCapacity = $StudentsCapacity;
        $this->id_professor = $id_professor;
        $this->id = $id;
    }

    protected function storeSubject() {
        $this->openConnection();

        try {
            $query = "INSERT INTO materia (nombre_materia, cantidad_max_alumnos, id_profesor) VALUES (:name, :maxStudent, :id_professor)";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':name' => $this->name,
                        ':maxStudent' => $this->StudentsCapacity,
                        ':id_professor' => $this->id_professor
                    ]
                );
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=Materia registrada con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
            die();
        }
    }
    protected function updateSubject() {
        $this->openConnection();
        try {
            $query = "UPDATE materia SET nombre_materia=:name, cantidad_max_alumnos = :maxStudent ,id_profesor=:id_professor WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':name' => $this->name,
                        ':maxStudent' => $this->StudentsCapacity,
                        ':id_profesor' => $this->id_professor,
                        ':id' => $this->id,
                    ]
            );
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=Materia actualizada con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }
    }
    protected function getOne($id) {
        $this->openConnection();

        try {
            $query = 'SELECT  * FROM materia where id = :id';
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
    // Paginacion no implementada
    protected function getPaginated($page = 1, $filters = []){
        $resultsPerPage = 2;

        $query = "SELECT id, nombre_completo, cedula, role_id, celular FROM usuarios";
        $queryCount = "SELECT COUNT(id) AS total_users FROM usuarios";

        $initialRegister = ($page - 1) * $resultsPerPage;
        $filterValues = [];

        $filtersCount = count($filters);

        if ($filtersCount) {
            $query .= ' WHERE';

            foreach($filters as $key => $filter) {
                switch($filter['value']) {
                    case 'searcher':
                        $text = ' nombre_completo LIKE %:search% OR cedula LIKE %:search%';
                        $query .= $text;
                        $queryCount .= $text;
                        $filterValues[':searcher'] = $filter['value'];
                        break;

                    case 'role':
                        $text = ' role_id = :role';
                        $query .= $text;
                        $queryCount .= $text;
                        $filterValues[':role'] = $filter['value'];
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
    protected function deleteSubject($id){
        $this->openConnection();
        
        try {
            $query = "DELETE FROM materia WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->execute(
                    [
                        ':id'=> $id,
                    ]
                );
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=Materia eliminada con éxito&success=1');
        } catch(PDOException $ex) {
            header('Location: http://localhost/CRUD-PHP/controllers/CareersController.php?message=' . $ex->getMessage() . '&success=0');
        } finally {
            $this->closeConnection();
        }  


    }
}