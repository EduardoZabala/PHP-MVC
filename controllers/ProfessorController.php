<?php
namespace controllers;
require_once(__DIR__ . '/../autoload.php');
use Models\Professor;
class ProfessorController extends Professor
{
    public function __construct() {}
    public function store($request) {
        $userId = $request['usuarioId'];
        $consult = $this->ExistUser($userId);
        if($consult->success){//Validacion si ya existe un usuarioId con profesor
            header('Location: http://localhost/CRUD-PHP/controllers/ClientsController.php?create=true&&message=Estudiante ya existe&success=0');
            return;
        }
        parent::__construct($userId);
        $this->storeProfessor();
    }
    //Este metodo es el que edita el valor de acuerdo al cuerpo del post
    public function edit($request) {
        $userId = $request['usuarioId'];
        $careerId = $request['careerId'];
        parent::__construct($careerId,$userId);
        $this->updateProfessor();
    }
}


//Aqui van a ir los manejos de las peticiones pero eso todavia no
