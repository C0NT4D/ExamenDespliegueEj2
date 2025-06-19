<?php
// Conexión a la base de datos
$servername = getenv('MYSQL_HOST') ?: 'mysql';
$username = getenv('MYSQL_USER') ?: 'michael';
$password = getenv('MYSQL_PASSWORD') ?: 'michael1234';
$dbname = getenv('MYSQL_DATABASE') ?: 'discos';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los coches
$sql = "SELECT * FROM discos_mas_vendidos ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-top: 20px;
        }
        img {
            cursor: pointer;
            transition: transform 0.3s;
        }
        img:hover {
            transform: scale(1.1);
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .modal img {
            max-width: 90%;
            max-height: 90%;
        }
        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 40px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Discos más vendidos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Ventas</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['autor']); ?></td>
                    <td><?php echo $row['anyo']; ?></td>
					<td><?php echo htmlspecialchars($row['ventas']); ?></td>
                    <td>
                        <?php if (!empty($row['imagen'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo $row['imagen']; ?>" 
                                 alt="Imagen del disco" 
                                 style="width: 100px; height: auto;" 
                                 onclick="mostrarImagen(this)">
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Modal para la imagen en grande -->
    <div id="modal" class="modal">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <img id="modal-img">
    </div>

    <script>
        function mostrarImagen(img) {
            document.getElementById("modal-img").src = img.src;
            document.getElementById("modal").style.display = "flex";
        }

        function cerrarModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>

