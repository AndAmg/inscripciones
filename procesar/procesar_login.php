<?php
session_start();
require_once("../conexion/conexion.php");

$correo = trim($_POST['correo']);
$clave = trim($_POST['clave']);

$sql = "SELECT id, nombre, clave FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    if ($clave === $usuario['clave']) {  // comparación plana
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['correo'] = $correo;
        header("Location: ../vistas/inscripcion.php");
        exit();
    } else {
        $_SESSION['error_login'] = "Contraseña incorrecta.";
        header("Location: ../vistas/login.php");
        exit();
    }
} else {
    $_SESSION['error_login'] = "Usuario no registrado.";
    header("Location: ../vistas/login.php");
    exit();
}
$stmt->close();
$conn->close();
