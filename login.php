<?php
require "db.php";
$mensaje = "";

if ($_POST) {
    $correo = $_POST["correo"];
    $pass = $_POST["contraseña"];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contraseña='$pass'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        session_start();
        $_SESSION["usuario"] = $correo;
        header("Location: bienvenida.php");
        exit;
    } else {
        $mensaje = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <h1>Inicio de Sesión</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="registro.php">Registro</a>
        <a href="login.php">Inicio de sesión</a>
    </nav>
</header>

<h2>Inicia sesión</h2>

<form method="POST" class="form">

    <label>Correo
        <input type="email" name="correo" required>
    </label>

    <label>Contraseña
        <input type="password" name="contraseña" required>
    </label>

    <button type="submit">Entrar</button>

    <p class="mensaje"><?= $mensaje ?></p>

</form>

</body>
</html>
