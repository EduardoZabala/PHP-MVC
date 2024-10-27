<?
include_once 'Validaciones.php';
include_once 'model/conexion.php';
class VerificarEntrada extends Validaciones{
    public $Errors = [];
    public $conexion = new Conexion();
    
    public function VerificarCedula($Cedula){
        if (!$this->validateCedula($Cedula)) {
            $this->Errors[] = "La cédula debe contener solo números.";
        }elseif($this->ConsultarCedula($Cedula,$this->conexion)){
            $this->Errors[]= "La cedula ya existe ";
        }
    }
    public function VerificarCampos($campo){
        if($this->required($campo)){
            $this->Errors[]="El campo $campo es requerido";
        }
    }

    public function MostrarErrores(){
        foreach ($this->Errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }

}