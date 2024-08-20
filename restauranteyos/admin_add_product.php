<?php
include 'db.php';
session_start();

if ($_SESSION['rol'] != 'admin') {
    echo "No tienes permisos para acceder a esta página.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, disponible) VALUES ('$nombre_producto', '$descripcion', '$precio', '$disponible')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - [Nombre del Restaurante]</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Reset de margenes y padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            color: #fff;
            text-align: center;
            font-size: 2.5rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #d9f99d;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #4CAF50;
        }

        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container textarea {
            height: 100px;
            resize: none;
        }

        .form-container label {
            font-size: 1rem;
            color: #555;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .form-container label input {
            margin-right: 10px;
        }

        .form-container button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
            color: #fff;
            margin-top: 50px;
        }

        footer p {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin-bottom: 10px;
            }

            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Agregar Producto</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Panel de Administración</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="form-container">
            <h2>Registro de Producto</h2>
            <form method="POST" action="admin_add_product.php">
                <input type="text" name="nombre_producto" placeholder="Nombre del Producto" required>
                <textarea name="descripcion" placeholder="Descripción" required></textarea>
                <input type="number" step="0.01" name="precio" placeholder="Precio" required>
                <label>
                    <input type="checkbox" name="disponible" checked> Disponible
                </label>
                <button type="submit">Agregar Producto</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 [Nombre del Restaurante]. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
