<?php
namespace controllers;
require_once(__DIR__ . '/../autoload.php');
use Models\Careers;
class CareersController extends Careers
{
 
    public function __construct() {}

    public function create() {
        $title = 'Crear Carrera';
        require_once(__DIR__ . '/../views/CareerManager.php');
    }
    public function store($request) {
        $name = $request['txtNombre'];
        parent::__construct($name);
        $this->storeCareer();
    }
    public function index(){
        
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = $this->getPaginated($page);
        
        require_once('../views/TablesCareer.php');
    }
    //Este metodo es el que trae los datos y los coloca en el formulario
    public function update($result ) {

        if ($result->status === 200) {
            $userData = $result->user;
            $title = 'Editar carrera';
            require_once('../views/CareerManager.php');
        }
    }
    public function getCarrer($id) {

        return $this->getOne($id);
    }
    //Este metodo es el que edita el valor de acuerdo al cuerpo del post
    public function edit($request) {
        $name = $request['txtNombre'];
        $id = $request['userId'];
        parent::__construct($name,$id);
        $this->updateCareer();
    }
    public function delete($id){
        $this->deleteCareer($id);
    }
}

$controllerInstance = new CareersController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if(isset($_GET['create'])) {
        $controllerInstance->Create();
    }else if(isset($_GET['userId'])){
        $result = $controllerInstance->getCarrer($_GET['userId']);//Trae los datos de la busqueda
        $controllerInstance->update($result);
    }else if(isset($_GET['deleteId'])){
        $controllerInstance->delete($_GET['deleteId']);
    }else{
           $controllerInstance->index();
    }  
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])){
        $controllerInstance->store($_POST);
    }else if(isset($_POST['userId'])){
        $controllerInstance->edit($_POST);
    }
}

