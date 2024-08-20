<?php
include 'db.php';
session_start();

if ($_SESSION['rol'] != 'admin') {
    echo "<div class='error-msg'>No tienes permisos para acceder a esta página.</div>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero, eliminar las referencias del producto en la tabla orden_detalles
    $deleteDetailsSql = "DELETE FROM orden_detalles WHERE id_producto=$id";
    if ($conn->query($deleteDetailsSql) === TRUE) {
        // Luego, eliminar el producto
        $deleteProductSql = "DELETE FROM productos WHERE id=$id";
        if ($conn->query($deleteProductSql) === TRUE) {
            header("Location: dashboard.php?delete=success");
            exit;
        } else {
            echo "<div class='error-msg'>Error al eliminar el producto: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='error-msg'>Error al eliminar las referencias del producto: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='error-msg'>ID de producto no proporcionado.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto - [Nombre del Restaurante]</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-msg {
            background-color: #ff4f4f;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        .error-msg h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .error-msg p {
            font-size: 1rem;
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
            display: inline-block;
        }

        a:hover {
            background-color: #45a049;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="error-msg">
        <h2>Error</h2>
        <p>No se pudo completar la solicitud. Por favor, intenta de nuevo.</p>
        <a href="dashboard.php">Volver al Panel de Administración</a>
    </div>
    <footer>
        <p>&copy; 2024 [Nombre del Restaurante]. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
