<?php
session_start(); // Inicia la sesión

// Destruye la sesión actual
session_unset();
session_destroy();

// Redirige al usuario a la página de inicio
header("Location: index.php");
exit;
?>
