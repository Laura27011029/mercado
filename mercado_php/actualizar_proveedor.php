<?php

// Conexión a la base de datos
include 'conexion.php';









//Obtener datos del formulario
$id_proveedor = $_POST['id_proveedor'];
$nombre_proveedor = $_POST['nombre _proveedor'];
$contacto_interno = $_POST['contacto_interno'];
$telefono_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$observaciones = $_POST['observaciones'];

//Actualizar los datos en la base de datos
$sql = "UPDATE proveedores SET nombre_proveedor = ?, contacto_interno = ?, telefono_contacto = ?, email_contacto = ?, direccion = ?, ciudad = ?, país = ?, observaciones = ? WHERE id_proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssi", $nombre_proveedor, $contacto_interno, $telefono_contacto, $email_contacto, $direccion, $ciudad, $pais, $observaciones, $id_proveedor);

if ($stmt->execute()) {
    echo "Proveedor actualizado correctamente.";
    echo "<br><a href='proveedores_crud.php'>Volver a la lista</a>";
} else {
    echo "Error al actualizar el proveedor: " . $conn->error;
}

$stmt->close();
$conn->close();
?>