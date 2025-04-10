<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado</title>
</head>
<body>
    <form id = "form" method = "post" name = "form">
        <fieldset>
            <legend>Categorias</legend>
            <label>Nombre categoria: <input type="text" name="categoria" size="40" maxlenght="10"> </label>
        </fieldset>

        <input type="button" value="Insertar datos" id="nuevo" name="nuevo" onclick="document.form.action='insertar.php';
        document.form.submit()"/>     

        <input type="button" value="Eliminar datos" id="eliminar" name="eliminar" onclick="document.form.action='eliminar.php';
        document.form.submit()"/>   

        <input type="button" value="Consultar" id="consultar" name="consultar" onclick="document.form.action='consultar.php';
        document.form.submit()"/>

        <input type="button" value="actualizar" id="actualizar" name="actualizar" onclick="document.form.action='frm_actualizar.php';
        document.form.submit()"/>

    </form>
    
</body>
</html>