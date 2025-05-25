<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once("../conexion/conexion.php");

// Obtener lista de cursos
$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscribirse a Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../img/fondo.jpg');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            color: #fff;
            min-height: 100vh;
        }
        .container-custom {
            background-color: rgba(0, 0, 0, 0.65);
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            margin-top: 60px;
            box-shadow: 0 0 15px rgba(0,0,0,0.7);
        }
        h2, h3 {
            color: #fff;
        }
        label {
            font-weight: 600;
        }
        .btn {
            margin-top: 15px;
        }
        a.btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <div class="container container-custom">
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>

        <div class="mb-4">
            <a href="mis_cursos.php" class="btn btn-info">Mis Cursos</a>
            <a href="../cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>

        <h3>Inscribirse a un Curso</h3>

        <form action="../procesar/procesar_inscripcion.php" method="POST">
            <div class="mb-3">
                <label for="curso_id" class="form-label">Selecciona un curso:</label>
                <select name="curso_id" id="curso_id" class="form-select" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($curso = $result->fetch_assoc()): ?>
                        <option value="<?= $curso['id'] ?>"><?= htmlspecialchars($curso['nombre']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Inscribirme</button>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
