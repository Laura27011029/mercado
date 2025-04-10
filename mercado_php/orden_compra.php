<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sqlProveedores = "SELECT id_proveedor, nombre_proveedor FROM proveedores";
$resultProveedores = $conn->query($sqlProveedores);

$sqlProductos = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, VALOR_PRODUCTO FROM productos";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <div class="container">
        <h2>Orden de Compra</h2>
        <div class="total-orden">Total Orden Actual: <span id="totalOrdenActual">$0.00</span></div>

        <form action="procesar_compra.php" method="post">
            <label>Fecha de Emisión:</label>
            <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

            <label>Proveedor:</label>
            <select name="id_proveedor" required>
                <option value="">Seleccionar proveedor</option>
                <?php while ($row = $resultProveedores->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_proveedor']; ?>"> <?php echo $row['nombre_proveedor']; ?> </option>
                <?php } ?>
            </select>

            <label>Estado de la Orden:</label>
            <select name="estado" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Procesada">Procesada</option>
                <option value="Cancelada">Cancelada</option>
            </select>

            <h3>Productos</h3>
            <table id="productosTable">
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </table>

            <button type="button" onclick="agregarProducto()">Agregar Producto</button>
            <input type="submit" value="Terminar Orden de Compra">
        </form>
    </div>

    <script>
        let productos = [];
        <?php while ($row = $resultProductos->fetch_assoc()) { ?>
            productos.push({
                id: <?php echo $row['ID_PRODUCTO']; ?>,
                nombre: "<?php echo addslashes($row['NOMBRE_PRODUCTO']); ?>",
                precio: <?php echo $row['VALOR_PRODUCTO']; ?>
            });
        <?php } ?>

        function agregarProducto() {
            const table = document.getElementById('productosTable');
            const row = table.insertRow();

            let select = document.createElement('select');
            select.name = 'productos[]';
            productos.forEach(prod => {
                let option = document.createElement('option');
                option.value = prod.id;
                option.text = ${prod.nombre} - ${prod.precio.toFixed(2)};
                select.appendChild(option);
            });
            select.onchange = actualizarTotal;
            row.insertCell(0).appendChild(select);

            let cantidad = document.createElement('input');
            cantidad.type = 'number';
            cantidad.name = 'cantidad[]';
            cantidad.min = 1;
            cantidad.value = 1;
            cantidad.oninput = actualizarTotal;
            row.insertCell(1).appendChild(cantidad);

            let precioUnitario = document.createElement('span');
            precioUnitario.innerText = "$0.00";
            row.insertCell(2).appendChild(precioUnitario);

            let total = document.createElement('span');
            total.innerText = "$0.00";
            row.insertCell(3).appendChild(total);

            let botonEliminar = document.createElement('button');
            botonEliminar.type = 'button';
            botonEliminar.innerText = 'Borrar';
            botonEliminar.classList.add('btn-delete');
            botonEliminar.onclick = function () {
                table.deleteRow(row.rowIndex);
                actualizarTotal();
            };
            row.insertCell(4).appendChild(botonEliminar);

            actualizarTotal();
        }

        function actualizarTotal() {
            const rows = document.querySelectorAll('#productosTable tr');
            let totalOrden = 0;

            rows.forEach((row, index) => {
                if (index === 0) return; // saltar la cabecera

                const select = row.cells[0].querySelector('select');
                const cantidad = parseInt(row.cells[1].querySelector('input').value) || 0;
                const producto = productos.find(p => p.id == select.value);

                if (producto) {
                    const precio = producto.precio;
                    const totalProducto = precio * cantidad;
                    row.cells[2].querySelector('span').innerText = $${precio.toFixed(2)};
                    row.cells[3].querySelector('span').innerText = $${totalProducto.toFixed(2)};
                    totalOrden += totalProducto;
                }
            });

            document.getElementById('totalOrdenActual').innerText = $${totalOrden.toFixed(2)};
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>