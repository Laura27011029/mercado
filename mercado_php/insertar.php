<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";
$name1 = $_POST['categoria'];

//Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check connection
if ($conn -> connect_error) {
    die ("Connection failed: " . $conn -> connect_error);
}

$sql = "INSERT INTO categoria(NOMBRE_CATEGORIA) VALUES ('$name1')";

if ($conn -> query($sql) === TRUE) {
    echo " New record created successfully ";
}
else {
    echo " Error: " . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>