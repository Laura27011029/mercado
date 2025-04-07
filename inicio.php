<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIA SESIÓN</title>
    <style>
        legend {font-size: 30px}      
    </style>
</head>
<body>
    <fieldset>
    <legend><b>Inicio de sesión</b></legend>
        <br>
        <form action="login.php" method = "POST">
            <label> Usuario:</label>           
            <input type="text" name = "usuario" required>
            <br><br>
            <label> Contraseña:</label>
            <input type="password" name = "password" required>
            <br><br>
            <button type="submit">Ingresar</button>  
        </form>
    </fieldset>
</body>
</html>