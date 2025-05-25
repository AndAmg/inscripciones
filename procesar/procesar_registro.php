<?php
session_start();
require_once("../conexion/conexion.php");

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$clave = trim($_POST['clave']);

// Validar que no existan campos vacíos
if (empty($nombre) || empty($correo) || empty($clave)) {
    $_SESSION['error_registro'] = "Todos los campos son obligatorios.";
    header("Location: ../vistas/registro.php");
    exit();
}

// Verificar si el correo ya existe
$sql = "SELECT id FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error_registro'] = "El correo ya está registrado.";
    header("Location: ../vistas/registro.php");
    exit();
}
$stmt->close();

// Insertar usuario sin encriptar contraseña (según pedido)
$sql = "INSERT INTO usuarios (nombre, correo, clave) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $clave);
if ($stmt->execute()) {
    // Registro exitoso, redirigir a login
    header("Location: ../vistas/login.php");
} else {
    $_SESSION['error_registro'] = "Error al registrar usuario.";
    header("Location: ../vistas/registro.php");
}
$stmt->close();
$conn->close();
exit();
