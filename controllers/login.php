<?php
// Iniciar la sesión
session_start();

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir la clase DB
    require_once '../database/DB.php';

    // Obtener los datos del formulario
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Instanciar la clase DB
    $db = new DB();

    // Realizar el login del usuario
    $usuario = $db->login($email, $pass);

    // Verificar si el login fue exitoso
    if ($usuario) {
        // Almacenar el nombre de usuario en una variable de sesión
        $_SESSION['usuario'] = $usuario['usuario'];
        // Redirigir al usuario al dashboard
        header("Location: ../view/dashboard.php");
        exit;
    } else {
        echo 'Error en el login. Por favor, intenta nuevamente.';
    }
} else {
    // Redirigir a la página de inicio si no se recibieron datos del formulario
    header("Location: ../index.php");
    exit;
}
?>
