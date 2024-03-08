<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="uikit/css/uikit.min.css" />
</head>
<body>
<div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-height-viewport">
    <div class="uk-card uk-card-default uk-card-body uk-width-medium">
        <h3 class="uk-card-title">Registro</h3>
        <form id="register-form" action="controllers/registro.php" method="POST" >
            <div class="uk-margin">
                <input class="uk-input" type="text" placeholder="Usuario" name="usuario" id="usuario" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="email" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="password" placeholder="Contraseña" name="pass" id="pass" required>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-width-1-1">Registrarse</button>
            </div>
        </form>
        <p class="uk-text-small uk-text-center">¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
    </div>
</div>

<script src="controllers/register.js"></script>
</body>
</html>
