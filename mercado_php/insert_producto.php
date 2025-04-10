<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = ($_POST['nombre_producto']);
    $cantidad_producto = intval($_POST['cantidad_producto']);
    $valor_producto = intval($_POST['valor_producto']);
    $id_categoria = intval($_POST['id_categoria']);

    $sql = "INSERT INTO productos (NOMBRE_PRODUCTO, CANTIDAD_PRODUCTO, VALOR_PRODUCTO, ID_CATEGORIA) VALUES (?, ?, ?, ?)";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("siii" ,$nombre_producto ,$cantidad_producto, $valor_producto,$id_categoria);

    if ($stmt -> execute()) {
        //Redirigir automaticamente a productos.php despues de insertar
        header("Location: productos.php");
        exit(); //Asegurar que el script se termina aquí
    }
    else {
        echo "Error al agregar el producto: ". $stmt -> error;
    }

    $stmt -> close();
    $conn -> close();
}
?>
