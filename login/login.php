
<!DOCTYPE hmtl>
<html>
<head>
    <title>Iniciar sesions</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Aqui colocaras tu archivo CSS -->
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- cs personalizado -->
    </head>
<body>
     <!-- Contenedor -->
     <div class="contenedor">
            <?php 
                echo "<a href='../login/iniciar.php' class='boton-cerrar'> Iniciar sesion </a>"; 
            ?>
                 <!--El usuario autenticado puede ver el listado de productos y hacer CRUD-->               
           </div>
           <div class="contenedor--flex"> 
                 <!--El usuario autenticado puede ver el listado de productos y hacer CRUD-->              
                <h1 id="titulo-inicio">Recetario</h1>
                <div class="buscar-inicio">
                    <h3>Busqueda de recetas</h3>
                    <input type="text" id="busqueda" placeholder="Buscar receta" name="query">
                    <ul id="lista-recetas"> 
                        <!-- Aqui se mostraran los resultados de la busqueda -->
                    </ul>
                </div> 
                
           </div>
           <div id='banner'><img id='banner_img' src="../recetas/img/banner_inicio.png"></div>
        <div class="contenedor--flex">
        <!--El usuario autenticado puede ver el listado de productos y hacer CRUD-->   
        <?php
            // conectarse a la base de datos 
            include '..\Configuracion/bd_r.php';
            // Variables de paginacion 
            // La pagina es la pagina actual, si no hay nada establecido, la pagina predeterminada es la 1 
            $pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
            // establecer cantidad de registros o filas de datos por pagina 
            $reg_por_pag= 5;
            // calcular para la clausula LIMIT de la consulta 
            $reg_num = ($reg_por_pag * $pag) - $reg_por_pag;
            $accion = isset ($_GET['accion']) ? $_GET['accion'] : "";
            // si fue redirigido desde eliminar.php
            if($accion=='deleted'){
                echo "<div class='alerta alerta-exitoso'>La receta se elimino.</div>";
            }
            //Seleccionar los datos para la pagina actual
            $consulta = "SELECT recetas.id_r as id, recetas.nombre_r as nombre, region.pais as region, tipos.nombre_t as tipo, usuario, recetas.imagen as imagen FROM recetas INNER JOIN region ON recetas.id_region = region.id_region INNER JOIN tipos ON recetas.id_tipo = tipos.id_tipo; LIMIT :reg_num, :reg_por_pag";
            $sentencia = $con->prepare($consulta);
            $sentencia->bindParam(":reg_num", $reg_num, PDO::PARAM_INT);
            $sentencia->bindParam(":reg_por_pag", $reg_por_pag, PDO::PARAM_INT);
            $sentencia->execute();
            // asi es como se obtiene el numero de filas/registros 
            $num = $sentencia->rowCOUNT();
            // link/enlace para crear el formulario de registro
            //verificar si encontraron mas de 0 registros
            if($num>0){
                // Obtener el contenido (recetas) 
                //fetch() es mas rapido que fetchA11()
                while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)){
                    // extraer fila/registro
                    // esto se hara con $fila['nombre'] para 
                    // solamente $nombre
                    extract($fila);
                    // creamos una nueva fila en la tabla por cada registro que haya 
                    echo"<div class='receta'>
                            <h2 class='receta--titulo'>{$nombre}</h2>
                            <p class='receta--subtitulo'>Tipo: {$tipo}</p>
                            <p class='receta--subtitulo'>Origen: {$region}</p>
                            <p class='receta--subtitulo'>Autor: {$usuario}</p>
                            <img src='../recetas/cargas/{$imagen}' class='img_celda''  />";
                            //Leer una receta
                            echo "<a href='Leer_una_inicio.php?id={$id}' class='boton-leer'> Ver mas...</a>";                    
                            
                            echo "";
                            echo "</div>";

                }
            // Fin de la tabla 
            echo "</div>";
               // PAGINACION
                // Contar el numero total de filas/registros 
                $consulta = "SELECT COUNT(*) as total_filas FROM recetas";
                $sentencia = $con->prepare($consulta);
                // Ejecutar la consulta
                $sentencia->execute();
                // Obtener el total de filas 
                $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
                $total_filas = $fila['total_filas'];
                // paginar registros
                $pag_url="/recetas_de_cocina_prueba/login/login.php?";
                include_once "../recetas/paginacion_r.php";
            }
            // si no se encontraron registros 
            else{
                echo "<div class='alerta-atencion'>No se encontraron recetas.</div>";
            }
        ?>
            </div> <!-- fin del contenedor -->
<!-- tu archivo JavaScript ira aqui -->
<script src="#"></script>
<script type='text/javascript'>
    // confirma eliminar el registro ?
    function borrar_producto (id) {
        var respuesta = confirm('Esta seguro?');
        if (respuesta) {
            // si el ususario clickea ok,
            // pasamos el Id a eliminar.php y ejecutamos la consulta de eliminacion 
            window.location = '/recetas_de_cocina/recetas/eliminar_r.php?id_r=' + id;
        }
    }
</script>
<!-- SCRIPT PARA LA BUSQUEDA DE PRODUCTOS -->
    <script>
$(document).ready(function() {
    $('#busqueda').on('input', function() {
        var consulta = $(this).val();
        if (consulta !== "") {
            $.ajax({
                url: '../recetas/buscar_r.php', // Cambiado de '..\recetas/buscar_r.php' a '../recetas/buscar_r.php'
                method: 'POST',
                data: { query: consulta },
                success: function(data) {
                    $('#lista-recetas').html(data);
                }
            });
        } else {
            $('#lista-recetas').empty();
        }
    });
});
    </script>
    <script src="#"></script>
</body>
</html>