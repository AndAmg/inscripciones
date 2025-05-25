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
</head>
<body class="container mt-5">

    <h2>Cursos en los que estás inscrito, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
    <a href="inscripcion.php" class="btn btn-secondary mb-3">Volver a inscribirse</a>
    <a href="../cerrar_sesion.php" class="btn btn-danger mb-3">Cerrar Sesión</a>

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

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
