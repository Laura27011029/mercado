<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_proveedor = $_POST['id_proveedor'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];  // El estado de la orden
$productos = $_POST['productos'];
$cantidades = $_POST['cantidad'];

// Calcular el total de la orden
$total_orden = 0;

foreach ($productos as $i => $id_producto) {
    $cantidad = $cantidades[$i];

    // Busca el precio del producto
    $sqlPrecio = "SELECT VALOR_PRODUCTO FROM productos WHERE ID_PRODUCTO=?";
    $stmtPrecio = $conn->prepare($sqlPrecio);
    $stmtPrecio->bind_param("i", $id_producto);
    $stmtPrecio->execute();
    $stmtPrecio->bind_result($precio_unitario);
    
    if ($stmtPrecio->fetch()) {
        $subtotal = $precio_unitario * $cantidad;
        $total_orden += $subtotal;
    } else {
        echo "Error: No se encontró el producto con ID $id_producto<br>";
    }
    $stmtPrecio->close();
}


// Insertar la orden en la tabla 'ordenes_compra' con el estado
$sqlOrden = "INSERT INTO ordenes_compra (id_proveedor, fecha, total, estado) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sqlOrden);
if (!$stmt) {
    die("Error en la preparación de la orden: " . $conn->error);
}

$stmt->bind_param("isds", $id_proveedor, $fecha, $total_orden, $estado);

if (!$stmt->execute()) {
    die("Error al insertar la orden: " . $stmt->error);
}

$id_orden = $stmt->insert_id;
$stmt->close();

// Insertar los productos de la orden en la tabla 'detalle_orden_compra'
$sqlDetalle = "INSERT INTO detalle_orden_compra (id_orden, id_producto, cantidad) VALUES (?, ?, ?)";
$stmtDetalle = $conn->prepare($sqlDetalle);
if (!$stmtDetalle) {
    die("Error en la preparación del detalle: " . $conn->error);
}
 
for ($i = 0; $i < count($productos); $i++) {
    $id_producto = $productos[$i];
    $cantidad = $cantidades[$i];
    $stmtDetalle->bind_param("iii", $id_orden, $id_producto, $cantidad);
    if (!$stmtDetalle->execute()) {
        die("Error al insertar el detalle: " . $stmtDetalle->error);
    }
}
$stmtDetalle->close();
$conn->close();

// Mostrar el total de la orden
echo "Orden registrada con éxito. Número de Orden " . $id_orden . "<br>";
echo "Total última orden $" . number_format($total_orden, 2);
?>