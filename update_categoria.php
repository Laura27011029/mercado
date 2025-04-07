<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mercado";

//Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check connection
if (isset($_POST['actualizar'])) {
    $id_categoria = $_POST['ID_CATEGORIA'];
    $nuevo_nombre = $_POST['nuevo_nombre'];

    //Preparar consulta SQL
    $sql = "UPDATE categoria SET NOMBRE_CATEGORIA = ? WHERE ID_CATEGORIA = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("si" ,$nuevo_nombre ,$id_categoria);

    /*bind_param() se usa en consultas preparadas con musqli
    sintaxis: $stmt -> bind_param("tipos", $var1, $var2, ...)
    "Si" -> Indicia el primer valor ($nuevo_nombre) es string (s)
    y el segundo ($id_categoria) es integer
    */

    if($stmt -> execute()) {
        echo "Categoria actualizada con éxito.";
    }
    else {
        echo "Error al actualizar la categoria: " . $stmt->error;
    }

    $stmt -> close();
    $conn -> close();
}
?>