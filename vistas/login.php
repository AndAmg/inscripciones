<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: mis_cursos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estilos.css" rel="stylesheet">
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Iniciar Sesión</h3>

            <!-- Mostrar mensajes de error -->
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                        echo $_SESSION['mensaje'];
                        unset($_SESSION['mensaje']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
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
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom">Ingresar</button>
                </div>
                <p class="mt-3 text-center">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
