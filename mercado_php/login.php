<?php
include 'conexion.php';

$user_nombre = $_POST['usuario'];
$pass_usuario = $_POST['password'];


$sql = "INSERT INTO inicio_sesion (user,psw) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt -> bind_param("ss", $user_nombre, $pass_usuario);

if ($stmt -> execute()) {
    header("location: menu.php");
} else {
    echo "Error de registro de usuario";
}

$stmt -> close();
$conn -> close();
?>