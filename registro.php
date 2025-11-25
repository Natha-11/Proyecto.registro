<?php
require "conexion.php";
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
        $sql = "INSERT INTO usuario (nombre, apellidos, correo, contraseña)
                VALUES ('$nombre', '$apellidos', '$correo', '$pass')";

        if ($conexion->query($sql)) {
            $mensaje = "usuario registrado correctamente.";
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

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

<header class="bg-primary text-white py-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h3 m-0">Registro</h1>
        <nav>
            <a href="index.php" class="text-white me-3 text-decoration-none">Inicio</a>
            <a href="registro.php" class="text-white me-3 text-decoration-none">Registro</a>
            <a href="login.php" class="text-white text-decoration-none">Inicio de sesión</a>
        </nav>
    </div>
</header>

<div class="container">
    <h2 class="mb-4 text-center">Formulario de Registro</h2>

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required minlength="6">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" name="confirmar" class="form-control" required minlength="6">
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>

            <p class="text-center mt-3 text-danger fw-semibold">
                <?= $mensaje ?>
            </p>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

