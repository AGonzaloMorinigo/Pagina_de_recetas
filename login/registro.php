<?php
session_start();
require_once('../Configuracion/bd_r.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        // aplicacion de encriptado a la contraseña 
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        // Verificar si el usuario ya existe 
        $sentencia = $con->prepare("SELECT id FROM usuario WHERE nombre = :nombre");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->execute();

        if ($sentencia->rowCount() > 0) {
            echo "El usuario ya existe. Intente con otro nombre de usuario.";
        } else {
            // Insertar el nuevo usuario en la base de datos 
            $sentencia = $con->prepare("INSERT INTO usuario (nombre, pass) VALUES (:nombre, :pass)");
            $sentencia->bindParam(':nombre', $nombre);
            $sentencia->bindParam(':pass', $pass);
            $sentencia->execute();

            echo "Registro exitoso!. Puede iniciar sesion <a href='iniciar.php'>Aqui</a>.";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body id="iniciar">
<h2 id="registro">Registro de Usuario</h2>
    <div class="registro">
    <form method="post">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" name="nombre" required><br>

        <label for="pass">Contraseña:</label>
        <input type="password" name="pass"required><br>

        <input type="submit" value="Registrarse">
    </form>
    </div>
</body>
</html>