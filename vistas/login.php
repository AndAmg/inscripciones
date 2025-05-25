<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: cursos.php"); // Redirigir si ya ha iniciado sesión
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1557682260-967874a0f6a8?auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        h2 {
            color: #ffffff;
        }

        label {
            color: #ffffff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #e0e0e0;
        }

        .btn-primary {
            background-color: #004080;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0066cc;
        }

        .text-white a {
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="glass-card">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <form action="../procesos/procesar_login.php" method="POST">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
        </div>
        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
    <div class="text-center mt-3 text-white">
        ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
    </div>
</div>

</body>
</html>

