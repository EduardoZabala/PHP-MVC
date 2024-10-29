<?php
namespace controllers;
require_once(__DIR__ . '/../autoload.php');
use Models\Students;
class StudentsController extends Students
{
 
    public function __construct() {}
    public function store($request) {
        $userId = $request['usuarioId'];
        $careerId = $request['careerId'];
        parent::__construct($careerId,$userId);
        $this->storeStudent();
    }
    //Este metodo es el que edita el valor de acuerdo al cuerpo del post
    public function edit($request) {
        $userId = $request['usuarioId'];
        $careerId = $request['careerId'];
        parent::__construct($careerId,$userId);
        $this->updateStudent();
    }
    public function delete($id){
        $this->deleteCareer($id);
    }
}

//Aqui van a ir los manejos de las peticiones pero eso todavia no
