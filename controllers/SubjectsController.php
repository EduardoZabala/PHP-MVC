<?php
namespace controllers;
require_once(__DIR__ . '/../autoload.php');
use Models\Subjects;
class SubjectsController extends Subjects
{
 
    public function __construct() {
    }

    public function store($request) {
        $name = $request['txtNombre'];
        $StudentsCapacity =$request['txtcantAlmn'];
        $id_professor =$request['professorId'];
        parent::__construct($name,$StudentsCapacity,$id_professor);
        $this->storeSubject();
    }
    
    public function getSubject($id) {

        return $this->getOne($id);
    }

}
