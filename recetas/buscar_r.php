<?php
// Configura la conexión a la base de datos
include '..\Configuracion\bd_r.php';

    // Obtiene el valor de búsqueda del cuadro de búsqueda
    $consulta = $_POST['query'];

   
    // Prepara y ejecuta la consulta SQL
    $sql = "SELECT * FROM recetas WHERE nombre_r LIKE :query OR ingredientes LIKE :query";
    $sentencia = $con->prepare($sql);
    $sentencia->bindValue(':query', '%' . $consulta . '%', PDO::PARAM_STR);
    $sentencia->execute();

    // Recorre los resultados y muestra las recetas
    while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . $fila['nombre_r'] . " - " . $fila['ingredientes'] . "</li>";
    }

?>
