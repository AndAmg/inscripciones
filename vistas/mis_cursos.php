<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once("../conexion/conexion.php");

$usuario_id = $_SESSION['usuario_id'];

$sql = "
    SELECT c.nombre, c.descripcion, i.fecha_inscripcion
    FROM cursos c
    JOIN inscripciones i ON c.id = i.curso_id
    WHERE i.usuario_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cursos Inscritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../img/fondo.jpg');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            color: #fff;
        }
        .container-custom {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
        }
        .btn {
            margin-right: 10px;
        }
        table {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5 container-custom">
        <h2 class="mb-4">Cursos en los que estás inscrito, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
        <div class="mb-4">
            <a href="inscripcion.php" class="btn btn-secondary">Volver a inscribirse</a>
            <a href="../cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Descripción</th>
                        <th>Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($curso = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($curso['nombre']) ?></td>
                            <td><?= htmlspecialchars($curso['descripcion']) ?></td>
                            <td><?= $curso['fecha_inscripcion'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No estás inscrito en ningún curso aún.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
