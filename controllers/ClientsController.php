<?php
namespace controllers;

require_once(__DIR__ . '/../autoload.php');
use Models\Client;
use Services\RoleService;
use Services\CareerService;
use Services\UserService;
use controllers\StudentsController;
class ClientsController extends Client
{
 
    public function __construct() {}

    public function create() {
        $title = 'Crear Cliente';
        $roleService = new RoleService();
        $roles = $roleService->getRoles();
        require_once(__DIR__ . '/../views/ClientManager.php');
    }
    public function store($request) {
        $name = $request['txtNombre'];
        $document = $request['txtCedula'];
        $role = $request['role'];
        $cellphone = $request['txtCelular'];
        $password = $request['txtContraseña'];
       
        parent::__construct($name, $document, $role, $cellphone, $password);
        $this->storeUser();
    }
    public function index(){
        $roleService = new RoleService();

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $roles = $roleService->getRoles();
        
        $results = $this->getPaginated($page);
        
        require_once('../index.php');
    }
    public function update($result ) {

        if ($result->status === 200) {

            $roleService = new RoleService();
            $userService = new UserService();
            $carrerService = new CareerService();
            $roles = $roleService->getRoles();
            $users = $userService->getUsers();
            $careers = $carrerService->getCarrers();
            // echo (json_encode($careers));
            $userData = $result->user;
            
            echo (json_encode($userData));
            $title = 'Editar usuario';
            require_once('../views/ClientManager.php');

        }
    }
    public function getUser($id) {

        return $this->getOne($id);
    }
    public function edit($request) {
        $name = $request['txtNombre'];
        $document = $request['txtCedula'];
        $role = $request['role'];
        $cellphone = $request['txtCelular'];
        $password = $request['txtContraseña'];
        $id = $request['userId'];
        parent::__construct($name, $document, $role, $cellphone, $password,$id);
        $this->updateUser();
    }
    public function delete($id){
        $this->deleteUser($id);
    }
}

$controllerInstance = new ClientsController();
$StudentInstance    = new StudentsController();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if(isset($_GET['create'])) {
        $controllerInstance->Create();
    }else if(isset($_GET['userId'])){
        $result = $controllerInstance->getUser($_GET['userId']);
        $controllerInstance->update($result);
    }else if(isset($_GET['deleteId'])){
        $controllerInstance->delete($_GET['deleteId']);
    }else{
        $controllerInstance->index();    
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])){
        $controllerInstance->store($_POST);
    }else if(isset($_POST['createStudent'])){
        $StudentInstance->store($_POST);
    }else if(isset($_POST['userId'])){
        $controllerInstance->edit($_POST);
    }
}

