<?php
session_start();
require_once("../conexion/conexion.php");

$correo = $_POST['correo'];
$clave = $_POST['clave'];

// Buscar usuario por correo
$sql = "SELECT id, nombre, clave FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña sin encriptar
    if ($clave === $usuario['clave']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['correo'] = $correo;
        header("Location: ../vistas/mis_cursos.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Contraseña incorrecta.";
        header("Location: ../vistas/login.php");
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Usuario no encontrado.";
    header("Location: ../vistas/login.php");
    exit();
}

$conn->close();
