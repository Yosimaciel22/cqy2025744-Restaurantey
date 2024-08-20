<?php
session_start();
include 'db.php'; // Incluye la conexión a la base de datos

// Verifica si el usuario ha iniciado sesión y si tiene el rol de 'cliente'
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'cliente') {
    // Si no ha iniciado sesión o no es un cliente, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// El resto del código solo se ejecuta si el usuario es un cliente autenticado
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido - Pizzeria Y</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
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
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin: 0 15px;
        }

        header nav ul li a {
            color: #f8f9fa;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
            color: #f1c40f;
        }

        main {
            padding: 20px;
            flex: 1;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .products-list {
            margin-top: 20px;
        }

        .product-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .product-item label {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-item input[type="number"] {
            margin-left: 10px;
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Realizar Pedido</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="form-container">
            <h2>Selecciona los productos</h2>
            <form method="POST" action="order_process.php">
                <div class="products-list">
                    <?php
                    // Aquí se cargan los productos desde la base de datos
                    $sql = "SELECT * FROM productos";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $checked = $row['disponible'] ? '' : 'disabled';
                        echo "<div class='product-item'>";
                        echo "<label>";
                        echo $row['nombre_producto'] . " ($" . $row['precio'] . ")";
                        echo "<input type='checkbox' name='productos[".$row['id']."]' value='1' $checked> ";
                        echo "<input type='number' name='cantidad[".$row['id']."]' min='1' value='0' style='width: 60px;' $checked> ";
                        echo "</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <button type="submit">Revisar Pedido</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Pizzeria Y. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
