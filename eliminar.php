<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mercado";
$name = $_POST['categoria'];

//Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check connection
if ($conn -> connect_error) {
    die ("Connection failed: " . $conn -> connect_error);
}

//SQL to delete a record
$sql = "DELETE FROM categoria WHERE NOMBRE_CATEGORIA = '$name' ";

if ($conn -> query($sql) === TRUE) {
    echo " Record deleted successfully ";
}
else {
    echo " Error deleting the record: " . $conn -> error;
}

$conn -> close();
?>