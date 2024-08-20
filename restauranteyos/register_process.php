<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $rol = $_POST['rol']; // Obtener el rol del formulario

    // Validar el rol
    if (!in_array($rol, ['admin', 'cliente'])) {
        echo "Rol no válido.";
        exit;
    }

    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña, rol) VALUES ('$nombre_usuario', '$correo', '$contraseña', '$rol')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
