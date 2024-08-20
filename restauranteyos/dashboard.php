<?php
include 'db.php';
session_start();

// Verificar que el usuario esté logueado como admin
if ($_SESSION['rol'] != 'admin') {
    echo "<div class='error-msg'>No tienes permisos para acceder a esta página.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - [Nombre del Restaurante]</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #000; /* Color negro para el texto */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            Color: black;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
        }

        header h1 {
            margin: 0;
            text-align: center;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        header nav ul li {
            display: inline;
            margin: 0 10px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        section {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
        }
        li {
            color:

        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Panel de Administración</h1>
            <nav>
                <ul>
                    <a href="admin_add_product.php">Agregar Producto</a>
                    <a href="logout.php">Cerrar Sesión</a>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <h2>Bienvenido, Administrador</h2>
        <p>Desde aquí puedes gestionar los productos del restaurante.</p>

        <section>
            <h3>Menú de Productos</h3>
            <?php
            // Mostrar productos
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Disponible</th><th>Acciones</th></tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre_producto'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>$" . $row['precio'] . "</td>";
                    echo "<td>" . ($row['disponible'] ? "Sí" : "No") . "</td>";
                    echo "<td>";
                    echo "<a href='admin_edit_product.php?id=" . $row['id'] . "'>Editar</a> | ";
                    echo "<a href='admin_delete_product.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este producto?');\">Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            ?>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 [Nombre del Restaurante]. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
