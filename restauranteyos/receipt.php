<?php
session_start();
include 'db.php';

// Verificar si el usuario ha iniciado sesión y es un cliente
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente') {
    echo "No tienes permisos para acceder a esta página. Debes iniciar sesión.";
    exit();
}

// Verificar que el ID de la orden esté presente en la URL
if (!isset($_GET['id_orden'])) {
    echo "ID de la orden no proporcionado.";
    exit();
}

$id_orden = (int)$_GET['id_orden'];

// Obtener detalles de la orden
$sql = "SELECT * FROM ordenes WHERE id = $id_orden";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $orden = $result->fetch_assoc();
} else {
    echo "Orden no encontrada o error en la consulta.";
    exit();
}

// Obtener los detalles de los productos de la orden
$sql = "SELECT p.nombre_producto, d.cantidad, d.precio FROM orden_detalles d 
        INNER JOIN productos p ON d.id_producto = p.id 
        WHERE d.id_orden = $id_orden";
$detalles = $conn->query($sql);

if (!$detalles) {
    echo "Error al obtener los detalles de la orden: " . $conn->error;
    exit();
}

// Manejar el cálculo del cambio si se ha enviado el formulario
$cambio = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dinero_ingresado = (float)$_POST['dinero_ingresado'];

    if ($dinero_ingresado < $orden['total']) {
        $error = "Saldo insuficiente. El dinero ingresado es menor al total de la orden.";
    } else {
        $cambio = $dinero_ingresado - $orden['total'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo - Pizzeria Y</title>
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
            background-image: url('https://images.unsplash.com/photo-1605709512362-9b57936dff29');
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

        .receipt-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        .receipt-container h2 {
            margin-top: 0;
        }

        .receipt-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .receipt-container table, .receipt-container th, .receipt-container td {
            border: 1px solid #ddd;
        }

        .receipt-container th, .receipt-container td {
            padding: 10px;
            text-align: left;
        }

        .receipt-container th {
            background-color: #f4f4f4;
        }

        .receipt-container form {
            margin-top: 20px;
        }

        .receipt-container label {
            display: block;
            margin-bottom: 10px;
        }

        .receipt-container input[type="number"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .receipt-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .receipt-container button:hover {
            background-color: #0056b3;
        }

        .error-msg {
            background-color: #ff4f4f;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
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
            <h1>Recibo</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="receipt-container">
            <h2>Detalles de la Orden #<?php echo $id_orden; ?></h2>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                <?php while ($detalle = $detalles->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $detalle['nombre_producto']; ?></td>
                    <td><?php echo $detalle['cantidad']; ?></td>
                    <td>$<?php echo $detalle['precio']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <p>Total: $<?php echo $orden['total']; ?></p>
            <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="receipt.php?id_orden=<?php echo $id_orden; ?>">
                <label for="dinero_ingresado">Dinero Ingresado:</label>
                <input type="number" name="dinero_ingresado" step="0.01" required>
                <button type="submit">Calcular Cambio</button>
            </form>
            <?php if ($cambio !== null && !$error): ?>
            <p>Cambio: $<?php echo number_format($cambio, 2); ?></p>
            <?php endif; ?>
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
