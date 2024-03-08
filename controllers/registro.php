<?php

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir la clase DB
    require_once '../database/DB.php';

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Instanciar la clase DB
    $db = new DB();

    // Realizar el registro del usuario
    $registroExitoso = $db->register($usuario, $email, $pass);

    // Verificar si el registro fue exitoso
    if ($registroExitoso) {
        echo 'Registro exitoso. ¡Bienvenido!';
    } else {
        echo 'Error en el registro. Por favor, intenta nuevamente.';
    }
} else {
    // Redirigir a la página de registro si no se recibieron datos del formulario
    header("Location: ../register.php");
    exit;
}
