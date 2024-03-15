<?php
session_start();

$usuario = $_SESSION['usuario'];

require_once '../database/DB.php';
$db = new DB();

$numeroCuenta = $db->consultarNumeroCuenta($usuario);
$saldo = $db->consultarSaldo($numeroCuenta);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="../uikit/css/uikit.min.css" />
    <style>
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding-top: 60px;
        }
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- UIkit navbar -->
<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <nav class="uk-navbar-container uk-navbar" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="#">Plataforma Bancaria De Bajos Recursos</a>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li><a href="dashboard.php">Inicio</a></li>
                <li><a href="enviar.php">Enviar Fondos</a></li>
                <li><a href="agregar.php">Añadir Fondos</a></li>
                <li><a href="#">Retirar Fondos</a></li>
                <li><a class="uk-button uk-button-danger" href="../controllers/logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- Contenido principal -->
<div class="uk-container uk-margin-large-top">
    <h1 class="uk-heading-medium">Retirar Fondos</h1>
    <form class="uk-form-stacked" action="../controllers/retirar.php" method="POST">
        <div class="uk-margin">
            <label class="uk-form-label" for="numerodecuenta_destino">Número de Cuenta:</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="numerodecuenta_destino" name="numerodecuenta_destino" type="text" placeholder="Número de Cuenta Destino" required>
            </div>
        </div>
        <div class="uk-margin">
            <label class="uk-form-label" for="monto">Monto a Enviar:</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="monto" name="monto" type="number" step="0.01" placeholder="Monto" required>
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit">Retirar Fondos</button>
        </div>
    </form>
</div>

<!-- UIkit JS -->
<script src="../uikit/js/uikit.min.js"></script>
<script src="../uikit/js/uikit-icons.min.js"></script>
</body>
</html>


