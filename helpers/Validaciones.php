<?php
class Validaciones{
    // Validar que un campo no esté vacío
    protected  function required($input) {
        return !empty(trim($input)); // Retorna true si el campo no está vacío
    }
    // Validar formato de correo electrónico
    protected function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Validar que un campo contenga solo números
    protected function validateCedula($cedula) {
        return preg_match("/^\d+$/", $cedula); // Verifica que solo contenga dígitos
    }
    // Sanitizar la entrada para evitar inyecciones de código
    protected function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    protected function ConsultarCedula($cedula,$conexion) {
        $sql = "SELECT * FROM persona WHERE CEDULA = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $cedula); // Vincular el parámetro cedula como entero
        $stmt->execute();
        $result = $stmt->get_result(); // Obtener el resultado de la consulta
        return $result->num_rows > 0;
    }
}