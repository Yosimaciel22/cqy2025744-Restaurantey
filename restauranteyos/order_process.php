<?php
include 'db.php';
session_start();

if ($_SESSION['rol'] != 'cliente') {
    echo "No tienes permisos para acceder a esta página.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['pedido_temp'] = [
        'productos' => $_POST['productos'],
        'cantidad' => $_POST['cantidad']
    ];

    header("Location: preview_order.php");
    exit;
}
?>
