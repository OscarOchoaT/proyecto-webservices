<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="uikit/css/uikit.min.css" />
</head>
<body>
<div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-height-viewport">
    <div class="uk-card uk-card-default uk-card-body uk-width-medium">
        <h3 class="uk-card-title">Login</h3>
        <form id="login-form" method="POST" action="controllers/login.php">
            <div class="uk-margin">
                <input class="uk-input" type="email" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="password" placeholder="Contraseña" name="pass" id="pass" required>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-width-1-1">Iniciar sesión</button>
            </div>
        </form>
        <p class="uk-text-small uk-text-center">¿No tienes una cuenta? <a href="register.php" id="signup-link">Regístrate aquí</a></p>
    </div>
</div>

<script src="uikit/js/uikit.min.js"></script>
<script src="uikit/js/uikit-icons.min.js"></script>
</body>
</html>
