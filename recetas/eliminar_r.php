<?php
// incluimos la conexion a la base de datos 
include '..\Configuracion/bd_r.php';
try {
    // obtenemos el id del registro
    // isset () es una funcion de PHP usada para verificar si un valor esta o no 
    $id=isset($_GET['id_r']) ? $_GET['id_r'] : die('ERROR: El ID de la receta no se encuentra.');
    // Aplicamos la consulta SQL para eliminar
    $consulta = "DELETE FROM recetas WHERE id_r = ?";
    $sentencia = $con->prepare($consulta);
    $sentencia->bindParam(1, $id);
    if($sentencia->execute()){
        //redirigimos a la pagina la lectura de registros y avisamos al usuario que el registro se elimino
        header('Location: /recetas_de_cocina_prueba/index_r.php?action=borrado');
    }else{
        die('Imposible borrar la receta.');
    }
}
    // si hay error, mostrar error 
    catch (PDOException $exception){
        die('ERROR: ' . $exception->getMessage()); 
}
?>