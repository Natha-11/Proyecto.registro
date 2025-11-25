<?php
session_start(); // IMPORTANTE: debe ir al inicio

require "conexion.php";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $pass = $_POST["contraseña"];

    // Consulta segura con prepared statements
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE correo=? AND contraseña=?");
    $stmt->bind_param("ss", $correo, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION["usuario"] = $correo; // Guardamos sesión
        header("Location: bienvenida.php");
        exit;
    } else {
        $mensaje = "Credenciales incorrectas.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">

<header class="bg-primary text-white py-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h3 m-0">Inicio de Sesión</h1>
        <nav>
            <a href="index.php" class="text-white me-3 text-decoration-none">Inicio</a>
            <a href="registro.php" class="text-white me-3 text-decoration-none">Registro</a>
            <a href="login.php" class="text-white text-decoration-none">Inicio de sesión</a>
        </nav>
    </div>
</header>

<div class="container">
    <h2 class="mb-4 text-center">Inicia sesión</h2>

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 450px;">
        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>

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
