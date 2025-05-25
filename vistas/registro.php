<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Registro de Usuario</h2>

    <?php if (isset($_SESSION['error_registro'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_registro']; unset($_SESSION['error_registro']); ?>
        </div>
    <?php endif; ?>

    <form action="../procesar/procesar_registro.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" name="correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña:</label>
            <input type="password" name="clave" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrarse</button>
        <a href="login.php" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
    </form>

</body>
</html>
