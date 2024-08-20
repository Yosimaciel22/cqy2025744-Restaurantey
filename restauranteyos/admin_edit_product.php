<?php
include 'db.php';
session_start();

// Verificar que el usuario esté logueado y sea admin
if ($_SESSION['rol'] != 'admin') {
    echo "<div class='error-msg'>No tienes permisos para acceder a esta página.</div>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        // Actualizar producto
        $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, disponible=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $nombre_producto, $descripcion, $precio, $disponible, $id);

        if ($stmt->execute()) {
            header("Location: dashboard.php?update=success");
            exit;
        } else {
            echo "<div class='error-msg'>Error: " . $stmt->error . "</div>";
        }
    } else {
        // Obtener detalles del producto
        $sql = "SELECT * FROM productos WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
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
    <title>Editar Producto - [Nombre del Restaurante]</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #218838;
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

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 15px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Editar Producto</h1>
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
            <h2>Actualizar Producto</h2>
            <form method="POST" action="">
                <input type="text" name="nombre_producto" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" placeholder="Nombre del Producto" required>
                <textarea name="descripcion" placeholder="Descripción" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" placeholder="Precio" required>
                <label>
                    <input type="checkbox" name="disponible" <?php echo $producto['disponible'] ? 'checked' : ''; ?>> Disponible
                </label>
                <button type="submit">Actualizar Producto</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 [Nombre del Restaurante]. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
