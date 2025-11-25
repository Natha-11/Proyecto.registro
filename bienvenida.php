<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <h1>Bienvenido</h1>
</header>

<h2>Has iniciado sesión como: <?= $usuario ?></h2>

<a href="login.php">Cerrar sesión</a>

</body>
</html>

