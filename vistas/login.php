<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Iniciar Sesión</h2>

    <?php if (isset($_SESSION['error_login'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_login']; unset($_SESSION['error_login']); ?>
        </div>
    <?php endif; ?>

    <form action="../procesar/procesar_login.php" method="POST">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" name="correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña:</label>
            <input type="password" name="clave" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        <a href="registro.php" class="btn btn-link">¿No tienes cuenta? Regístrate</a>
    </form>

</body>
</html>
