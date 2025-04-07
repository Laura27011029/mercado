<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mercado";

//Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check connection
if ($conn -> connect_error) {
    die ("Connection failed: " . $conn -> connect_error);
}

$sql = "SELECT NOMBRE_CATEGORIA FROM categoria";
$result = $conn -> query($sql);

if ($result -> num_rows > 0) {
    //output data of each row
    while ($row = $result -> fetch_assoc()) {
        echo "La categoria es: " . $row['NOMBRE_CATEGORIA'] . "<br>";
    }
}
else {
    echo "0 results";
}

$conn -> close();
?>