<?php
session_start();
require_once('../Configuracion/bd_r.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];
    //verifica que exista el usuario en la tabla de usuarios de la base de datos 
    $sentencia = $con->prepare("SELECT nombre, pass FROM usuario WHERE nombre = :nombre");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->execute();
    $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
    // si existe el usuario, habilita la pagina INDEX con la lista de productos para poder hacer C.R.U.D
    if ($fila && password_verify($pass, $fila['pass'])) {
        $_SESSION['nombre'] = $nombre;
        header("Location: ../index.php");
        // Si no existe el usuario, podra registrarse o intentar nuevamente...
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body id="iniciar">
<div class="inicio">
    <h2>Iniciar Sesion</h2>
                <form method="post" class="inicio">
                    <label for="nombre">Nombre de Usuario:</label>
                    <input type="text" name="nombre" required><br>

                    <label for="pass">Contraseña:</label>
                    <input type="text" name="pass" required><br>
                    <input type="submit" value="Iniciar Sesion">
                </form>
                <?php if (isset($error_message)) { ?>
                    <p><?php echo $error_message; ?></p>
                    <?php } ?>
                    
                    <p>¿No tienes cuenta? <a href="registro.php">Registrate</a></p>
   </div>
</body>