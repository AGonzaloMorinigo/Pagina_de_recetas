
<!DOCTYPE html>
<html>
<head>
    <title>Actualizar una receta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Aqui va tu archivo CSS -->
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <!-- contenedor -->
    <div class="contenedor-crear">
        <div class="encabezado-pagina">
            <h1>Actualizar receta</h1>
        </div>
        <?php
            // obtener el valor del parametro enviado, en este caso, el ID del registro 
            // isset() es una funcion de PHP usada para verificar si un valor esta o no 
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: El ID del registro no se encuentra. ' );
            //se incluye conexion a la base de datos 
            include '../Configuracion/bd_r.php';
            // leer los datos del registro actual 
try {
    // preparar consulta de seleccion 
    $consulta = "SELECT id_r, nombre_r, ingredientes, elaboracion, imagen, id_tipo, id_region FROM recetas WHERE id_r = ? LIMIT 0,1";
    $sentencia = $con->prepare($consulta);
    // este es el primer signo de interrogacion 
    $sentencia->bindParam(1, $id, PDO::PARAM_INT);
    // se ejecuta la consulta 
    $sentencia->execute();
    // se almacena la fila (registro) recuperada en una variable 
    $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
    //Valores a llenar en nuestro formulario 
    $nombre = $fila['nombre_r'];
    $ingredientes = $fila['ingredientes'];
    $elaboracion = $fila['elaboracion'];
    $imagen = $fila['imagen'];
    $tipo = $fila['id_tipo'];
    $region = $fila['id_region'];
    
}
// si hay error, mostrar error 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
        <?php
        // verificamos si el formulario fue enviado 
        if($_POST){
            try {
                //escribimos la consulta de la actulizacion
                //en este caso, vemos cuantos campos se deben pasar y 
                //es mejor etiquetarlos sin usar signos de interrogacion
                $consulta = "UPDATE recetas
                SET nombre_r=:nombre, ingredientes=:ingredientes, elaboracion=:elaboracion, imagen=:imagen, id_tipo=:tipo, id_region=:region
                WHERE id_r=:id";
                //preparar consulta para ejecucion
                $sentencia = $con->prepare($consulta);
                // enviar los valores 
                $nombre=htmlspecialchars(strip_tags($_POST['nombre']));
                $ingredientes=htmlspecialchars(strip_tags($_POST['ingredientes']));
                $elaboracion=htmlspecialchars(strip_tags($_POST['elaboracion']));
                $imagen=htmlspecialchars(strip_tags($_POST['imagen']));
                $tipo=htmlspecialchars(strip_tags($_POST['tipo']));
                $region=htmlspecialchars(strip_tags($_POST['region']));
               
                //enlazar los parametros
                $sentencia->bindParam(':nombre', $nombre);
                $sentencia->bindParam(':ingredientes', $ingredientes);
                $sentencia->bindParam(':elaboracion', $elaboracion);
                $sentencia->bindParam(':imagen', $imagen);
                $sentencia->bindParam(':tipo', $tipo);
                $sentencia->bindParam(':region', $region);
                $sentencia->bindParam(':id', $id);

                
                // ejecutar la consola 
                if($sentencia->execute()){
                    echo "<div class='exito'>El registro se actualizo.</div>";
                } else {
                    echo "<div class='alerta alerta-fallido'>Imposible actualizar el registro. Por favor, pruebe nuevamente.</div>";
                }
            }
            // Si hay errores mostrarlo 
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
        <!-- Tendremos nuestro formulario html aqui para actualizar la informacion del registro selecciondo --> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]. "?id={$id}");?>" method="post">
            <table class='tabla tabla-flotante tabla-responsiva tabla-bordeada'>
                <tr>
                    <td id="nombre-crear">Nombre:</td>
                    <td><input type='text' name='nombre' value="<?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>" class='control-formulario'/></td>
                </tr>
                <tr>
                    <td id="ingredientes-crear">Ingredientes:</td>
                    <td><textarea name='ingredientes' class='control-formulario' cols="60" rows="10"><?php echo htmlspecialchars($ingredientes, ENT_QUOTES); ?></textarea></td>
                </tr>
                <tr>
                    <td id="elaboracion-crear">Elaboracion:</td>
                    <td><textarea name='elaboracion' class='control-formulario' cols="60" rows="10" minlength="300"><?php echo htmlspecialchars($elaboracion, ENT_QUOTES); ?></textarea></td>
                </tr>
                <tr>
                    <td>Imagen:</td>
                    <td><input type="file" name="imagen" id="imagen-crear"/></td>
                </tr>
                <tr>
                    <td id="tipo-editar">Tipo:</td>
                    <td>
                        <select name="tipo" required>
                            <?php
                            include '../Configuracion/bd_r.php';

                            // Consulta para obtener las categorias 
                            $stmt = $con->query("SELECT * FROM tipos");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id_tipo']}'>{$row['nombre_t']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td id="region-editar">Region:</td>
                    <td>
                        <select name="region" required>
                            <?php
                            include '../Configuracion/bd_r.php';

                            // Consulta para obtener las categorias 
                            $stmt = $con->query("SELECT * FROM region");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id_region']}'>{$row['pais']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Guardar Cambios' class='boton-principal-crear'/>
                        <a href='../index.php' class='boton-peligro-crear'>Volver a al Inicio</a>
                    </td>
                </tr>
            </table>
        </form>
    </div> <!-- Fin del contenedor -->
    <!-- Codigo JAVASCRIPT ira aqui -->
    <script src="#"></script>
</body>
</html>
