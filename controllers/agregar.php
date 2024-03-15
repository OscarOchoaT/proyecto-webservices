<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir la clase DB
    require_once '../database/DB.php';

    // Obtener los datos del formulario
    $numerodecuenta = $_POST['numerodecuenta_destino'];
    $monto = $_POST['monto'];

    // Instanciar la clase DB
    $db = new DB();

    // Realizar la operación de agregar fondos
    $operacionExitosa = $db->agregarFondos($numerodecuenta, $monto);

    // Verificar si la operación fue exitosa
    if ($operacionExitosa) {
        // Redirigir al usuario al dashboard o a una página de confirmación
        header("Location: ../view/dashboard.php");
        exit;
    } else {
        echo 'Error al agregar fondos. Por favor, verifica los datos e intenta nuevamente.';
    }
} else {
    // Redirigir a la página de agregar fondos si no se recibieron datos del formulario
    header("Location: ../agregar_fondos.php");
    exit;
}
?>
