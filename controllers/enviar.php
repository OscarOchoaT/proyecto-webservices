<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir la clase DB
    require_once '../database/DB.php';

    // Obtener los datos del formulario
    $numerodecuenta_origen = $_POST['numerodecuenta_origen'];
    $numerodecuenta_destino = $_POST['numerodecuenta_destino'];
    $monto = $_POST['monto'];

    // Instanciar la clase DB
    $db = new DB();

    // Realizar la transferencia de fondos
    $transferenciaExitosa = $db->enviarFondos($numerodecuenta_origen, $numerodecuenta_destino, $monto);

    // Verificar si la transferencia fue exitosa
    if ($transferenciaExitosa) {
        // Redirigir al usuario al dashboard o a una página de confirmación
        header("Location: ../view/dashboard.php");
        exit;
    } else {
        echo 'Error al enviar fondos. Por favor, verifica los datos e intenta nuevamente.';
    }
} else {
    // Redirigir a la página de envío de fondos si no se recibieron datos del formulario
    header("Location: ../enviar_fondos.php");
    exit;
}
?>
