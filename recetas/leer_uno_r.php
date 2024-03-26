
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la receta</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>    
        <?php
            // obtener el valor del parametro ingresado, en este caso, el ID del registro 
            // isset() es una funcion de PHP usada para verificar si un valor esta o no 
            $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: El ID de la receta no se encuentra.');
            // Se incluye conexion a la base de datos 
            include '..\Configuracion/bd_r.php';
            // leer los datos del registro actual 
            try {
                // preparar consulta de seleccion 
                $consulta = "SELECT recetas.*, tipos.nombre_t, region.pais, recetas.nombre_r, recetas.ingredientes, recetas.elaboracion FROM recetas 
                INNER JOIN tipos ON recetas.id_tipo = tipos.id_tipo INNER JOIN region on recetas.id_region = region.id_region WHERE recetas.id_r =  ? LIMIT 0,1"; 
                $sentencia = $con->prepare( $consulta);
                // este es el primer signo de interrogacion 
                $sentencia->bindParam(1, $id);
                // se ejecuta la consulta 
                $sentencia->execute();
                // se almacena la fila (registro) recuperada en un variable 
                $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
                // values to fill up our form 
                $nombre_r = $fila['nombre_r'];
                $ingredientes = $fila['ingredientes'];
                $elaboracion = $fila['elaboracion'];
                $tipo = $fila['nombre_t'];
                $region = $fila['pais'];
                $imagen = htmlspecialchars($fila['imagen'], ENT_QUOTES);
            }
            // si hay error, mostrar error 
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        ?>
        <div class="contenedor">
        <div class="encabezado-pagina">
            <h1><?php echo htmlspecialchars($nombre_r, ENT_QUOTES); ?></h1>
        </div>
        <div class="contenedor-datos">
             <div class="datos-receta">
                <h2>Tipo, Región e Ingredientes:</h2>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($tipo, ENT_QUOTES); ?></p>
                <p><strong>Región:</strong> <?php echo htmlspecialchars($region, ENT_QUOTES); ?></p>
                <p><strong>Ingredientes:</strong></p> <p><?php echo htmlspecialchars($ingredientes, ENT_QUOTES); ?></p>
            </div>
            <div class="elaboracion">
                <h2>Elaboración:</h2>
                <p><?php echo htmlspecialchars($elaboracion, ENT_QUOTES); ?></p>
            </div>
        </div> 
        <div class="pie1">
            <h2>Imagen:</h2>
            <p>
                <?php echo $imagen ? "<img src='cargas/{$imagen}' style='width:300px;'/>" : "No se encontró imagen."; ?>
            </p>
        </div>

        <div class="pie">
            <a href='../index.php' class='boton-peligro'>Volver al Inicio</a>
        </div>
    </div> <!-- Fin del contenedor -->
</body>
</html>