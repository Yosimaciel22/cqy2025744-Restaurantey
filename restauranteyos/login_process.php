<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contraseña, $user['contraseña'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['rol'] = $user['rol'];
            if ($user['rol'] == 'admin') {
                header("Location: dashboard.php"); // Redirige al panel de administración
            } else {
                header("Location: order.php"); // Redirige a la página de pedidos
            }
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No existe una cuenta con ese correo";
    }
}
?>
