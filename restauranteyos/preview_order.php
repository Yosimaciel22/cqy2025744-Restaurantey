<?php
session_start();
include 'db.php';

// Verificar si el usuario ha iniciado sesión y es un cliente
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente') {
    echo "No tienes permisos para acceder a esta página. Debes iniciar sesión.";
    exit();
}

// Verificar si se han seleccionado productos
if (!isset($_SESSION['pedido_temp']) || empty($_SESSION['pedido_temp']['productos'])) {
    // Si no se han seleccionado productos, redirigir al usuario a la página de selección de productos
    header("Location: order.php");
    exit();
}

// Obtener el pedido temporal desde la sesión
$pedido_temp = $_SESSION['pedido_temp'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Previa del Pedido - Pizzeria Y</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-image: url('https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        header {
            background-image: url('https://images.unsplash.com/photo-1574180045827-306d432e6e5b');
            background-size: cover;
            background-position: center;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px 0;
        }

        header .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 120px);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .products-list {
            margin-bottom: 20px;
        }

        .product-item {
            margin-bottom: 10px;
        }

        .product-item label {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-container button, .form-container a.button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .form-container button:hover, .form-container a.button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
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
            <h1>Vista Previa del Pedido</h1>
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
            <h2>Revisa tu pedido</h2>
            <form method="POST" action="confirm_order.php">
                <div class="products-list">
                    <?php
                    foreach ($pedido_temp['productos'] as $id_producto => $valor) {
                        if ($valor == '1' && isset($pedido_temp['cantidad'][$id_producto])) {
                            $cantidad = (int)$pedido_temp['cantidad'][$id_producto];
                            if ($cantidad > 0) {
                                $sql = "SELECT * FROM productos WHERE id = $id_producto";
                                $result = $conn->query($sql);
                                $producto = $result->fetch_assoc();

                                echo "<div class='product-item'>";
                                echo "<label>";
                                echo $producto['nombre_producto'] . " ($" . $producto['precio'] . ")";
                                echo "<input type='number' name='cantidad[$id_producto]' min='1' value='$cantidad' style='width: 60px;'> ";
                                echo "</label>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>
                </div>
                <button type="submit">Confirmar Pedido</button>
                <a href="order.php" class="button">Editar Pedido</a>
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
