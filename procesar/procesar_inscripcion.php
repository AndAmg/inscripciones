<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../vistas/login.php");
    exit();
}

require_once("../conexion/conexion.php");

$usuario_id = $_SESSION['usuario_id'];
$curso_id = $_POST['curso_id'] ?? '';

if (empty($curso_id)) {
    $_SESSION['error_inscripcion'] = "Debe seleccionar un curso.";
    header("Location: ../vistas/inscripcion.php");
    exit();
}

// Verificar si el usuario ya está inscrito en ese curso
$sql = "SELECT id FROM inscripciones WHERE usuario_id = ? AND curso_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $curso_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error_inscripcion'] = "Ya estás inscrito en este curso.";
    $stmt->close();
    header("Location: ../vistas/inscripcion.php");
    exit();
}
$stmt->close();

// Insertar inscripción
$sql = "INSERT INTO inscripciones (usuario_id, curso_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $curso_id);

if ($stmt->execute()) {
    $_SESSION['exito_inscripcion'] = "Inscripción realizada con éxito.";
    header("Location: ../vistas/inscripcion.php");
} else {
    $_SESSION['error_inscripcion'] = "Error al inscribirse.";
    header("Location: ../vistas/inscripcion.php");
}
$stmt->close();
$conn->close();
exit();
