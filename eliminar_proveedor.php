<?php
// Conexión a la base de datos
include 'conexion.php';











//Verificar si se recibió el ID del proveedor y si es un número válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_proveedor']) && is_numeric($_POST('id_proveedor'))) {
    $id_proveedor = intval($_POST['id_proveedor']); // Convertir a entero para seguridad
    
}
?>