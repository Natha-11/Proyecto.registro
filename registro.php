<?php
require "db.php";
$mensaje = "";

if ($_POST) {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $pass = $_POST["contraseña"];
    $confirmar = $_POST["confirmar"];

    // Validaciones
    if (empty($nombre) || empty($apellidos) || empty($correo) || empty($pass)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Correo inválido.";
    } elseif (strlen($pass) < 6) {
        $mensaje = "Contraseña mínimo 6 caracteres.";
    } elseif ($pass !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contraseña)
                VALUES ('$nombre', '$apellidos', '$correo', '$pass')";

        if ($conexion->query($sql)) {
            $mensaje = "Usuario registrado correctamente.";
        } else {
            $mensaje = "Error: Correo ya registrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <h1>Registro</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="registro.php">Registro</a>
        <a href="login.php">Inicio de sesión</a>
    </nav>
</header>

<h2>Formulario de Registro</h2>

<form method="POST" class="form">

    <label>Nombre  
        <input type="text" name="nombre" required>
    </label>

    <label>Apellidos  
        <input type="text" name="apellidos" required>
    </label>

    <label>Correo  
        <input type="email" name="correo" required>
    </label>

    <label>Contraseña  
        <input type="password" name="contraseña" required minlength="6">
    </label>

    <label>Confirmar Contraseña  
        <input type="password" name="confirmar" required minlength="6">
    </label>

    <button type="submit">Registrar</button>

    <p class="mensaje"><?= $mensaje ?></p>
</form>

</body>
</html>
