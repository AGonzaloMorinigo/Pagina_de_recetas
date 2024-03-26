<?php
    $host = "localhost";
    $nombre_db = "recetadecocina";
    $nombreusuario = "root";
    $password = "";
    try {
        $con = new PDO("mysql:host={$host};dbname={$nombre_db}", $nombreusuario, $password);
       
    }
    catch (PDOException $exception) {
        echo "Error de conexion: " . $exception->getMessage();
    }
?>