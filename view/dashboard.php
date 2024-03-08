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
            <a class="uk-navbar-item uk-logo" href="#">Banco Petuche</a>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Configuración</a></li>
                <li><a href="#">Ayuda</a></li>
                <li><a class="uk-button uk-button-danger" href="../controllers/logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- Contenido principal -->
<div class="content">
    <h1 class="uk-heading-medium">Bienvenido!</h1>
    <p>¡Has iniciado sesión correctamente en tu dashboard!</p>
    <p>Este es un ejemplo básico de un dashboard con menú deslizante utilizando UIkit.</p>
</div>

<!-- UIkit JS -->
<script src="../uikit/js/uikit.min.js"></script>
<script src="../uikit/js/uikit-icons.min.js"></script>
</body>
</html>
