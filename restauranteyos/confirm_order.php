<?php
include 'db.php';
session_start();

// Verificar que el usuario esté logueado como cliente
if ($_SESSION['rol'] != 'cliente') {
    echo "<div class='error-msg'>No tienes permisos para acceder a esta página.</div>";
    exit;
}

// Verificar que se ha enviado un pedido
if (!isset($_POST['cantidad']) || !is_array($_POST['cantidad'])) {
    header("Location: order.php");
    exit;
}

$pedido_temp = $_POST['cantidad'];
$id_usuario = $_SESSION['usuario_id'];
$total = 0;

// Iniciar la transacción
$conn->begin_transaction();

try {
    // Crear una nueva orden
    $sql = "INSERT INTO ordenes (id_usuario, total) VALUES (?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        $id_orden = $conn->insert_id;

        foreach ($pedido_temp as $id_producto => $cantidad) {
            $cantidad = (int)$cantidad;
            if ($cantidad > 0) {
                $result = $conn->query("SELECT precio, disponible FROM productos WHERE id = $id_producto");
                $producto = $result->fetch_assoc();

                if ($producto['disponible']) {
                    $precio_total = $producto['precio'] * $cantidad;
                    $total += $precio_total;
                    
                    // Insertar detalles de la orden
                    $sql = "INSERT INTO orden_detalles (id_orden, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iiid", $id_orden, $id_producto, $cantidad, $precio_total);
                    $stmt->execute();
                }
            }
        }

        // Actualizar el total de la orden
        $sql = "UPDATE ordenes SET total = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $total, $id_orden);
        $stmt->execute();

        // Confirmar la transacción
        $conn->commit();

        // Limpiar la sesión del pedido temporal
        unset($_SESSION['pedido_temp']);

        header("Location: receipt.php?id_orden=$id_orden");
        exit;
    } else {
        throw new Exception("Error al crear la orden: " . $conn->error);
    }
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    echo "<div class='error-msg'>Error al procesar el pedido: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Pedido - [Nombre del Restaurante]</title>
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

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message {
            text-align: center;
            padding: 20px;
            font-size: 18px;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <p>Tu pedido está siendo procesado. Por favor, espera...</p>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 [Nombre del Restaurante]. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
