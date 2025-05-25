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
</head>
<body class="container mt-5">

    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
    <a href="mis_cursos.php" class="btn btn-info mb-3">Mis Cursos</a>
    <a href="../cerrar_sesion.php" class="btn btn-danger mb-3">Cerrar Sesión</a>

    <h3>Inscribirse a un Curso</h3>

    <form action="../procesar/procesar_inscripcion.php" method="POST">
        <div class="mb-3">
            <label for="curso_id" class="form-label">Selecciona un curso:</label>
            <select name="curso_id" id="curso_id" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php while ($curso = $result->fetch_assoc()): ?>
                    <option value="<?= $curso['id'] ?>"><?= htmlspecialchars($curso['nombre']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Inscribirme</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
