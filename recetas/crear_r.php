<?php
session_start(); 
if(isset($_SESSION['nombre'])) {
    $usuario = $_SESSION['nombre'];
} else {
    $usuario = "Nombre de usuario por defecto"; 
}
?>


<!DOCTYPE HTML>
<html>
<head>
    <title> Crear una receta</title>
	<link rel="stylesheet" href="../css/estilo.css">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
<body>
<body>
    <!-- Contenedor -->
    <div class="contenedor-crear">
        <div class="Encabezado-pagina">
            <h1>Crear Receta</h1>
        </div>
		<?php
			if($_POST){			 
				// incluir la conexión a la base de datos
				include '../Configuracion/bd_r.php';
			 
				try{			 
					// consulta de inserción
					$consulta = "INSERT INTO recetas SET nombre_r=:nombre, ingredientes=:ingredientes, elaboracion=:elaboracion, imagen=:imagen, id_tipo=:tipo, id_region=:region , usuario=:usuario";
			 
					// preparamos la consulta para su ejecución
					$sentencia = $con->prepare($consulta);
			 
					// publicamos sus valores
					$nombre=htmlspecialchars(strip_tags($_POST['nombre']));
					$ingredientes=htmlspecialchars(strip_tags($_POST['ingredientes']));
					$elaboracion=htmlspecialchars(strip_tags($_POST['elaboracion']));
					// nuevo campo 'imagen'
					$imagen=!empty($_FILES["imagen"]["name"])
					? sha1_file($_FILES['imagen']['tmp_name']) . "-" . basename($_FILES["imagen"]["name"]): "";
					$imagen=htmlspecialchars(strip_tags($imagen));
					$tipo=htmlspecialchars(strip_tags($_POST['tipo']));
					$region=htmlspecialchars(strip_tags($_POST['region']));
					$usuario = htmlspecialchars(strip_tags($usuario));
					
					// enlazamos los parámetros
					$sentencia->bindParam(':nombre', $nombre);
					$sentencia->bindParam(':ingredientes', $ingredientes);
					$sentencia->bindParam(':elaboracion', $elaboracion);
					$sentencia->bindParam(':imagen', $imagen);
					$sentencia->bindParam(':tipo', $tipo); 
					$sentencia->bindParam(':region', $region); 
					$sentencia->bindParam(':usuario', $usuario);

					// Executa la consulta
					if($sentencia->execute()){
						echo "<div class='exito'>La receta  ha sido guardada.</div>";
						// ahora, si imagen no está vacía, intente cargarla
						if($imagen){
						 
							// La función sha1_file() se usa para hacer un nombre de archivo único
							$directorio_destino = "cargas/";
							$archivo_destino = $directorio_destino . $imagen;
							$tipo_archivo = pathinfo($archivo_destino, PATHINFO_EXTENSION);
						 
							//mensaje de error si está vacío 
							$msj_error_carga_archivo="";
							
							// asegurar que el archivo es una imagen real
							$check = getimagesize($_FILES["imagen"]["tmp_name"]);
							if($check!==false){
								//el archivo enviado es una imagen
							}else{
								$msj_error_carga_archivo.="<div>El archivo enviado no es una imagen.</div>";
							}
							// asegura que ciertos tipos de archivos estén permitidos
							$tipos_permitidos=array("jpg", "jpeg", "png", "gif");
							if(!in_array($tipo_archivo, $tipos_permitidos)){
								$msj_error_carga_archivo.="<div>Solo se permiten archivos JPG, JPEG, PNG, GIF.</div>";
							}
							
							// Asegurarse que no exista 
							if(file_exists($archivo_destino)){
								$msj_error_carga_archivo.="<div>La imagen ya existe. Cambia el nombre.</div>";
							}
							
							// asegurarse que el archivo enviado no tenga más de 1 MB
							if($_FILES['imagen']['size'] > (1024000)){
								$msj_error_carga_archivo.="<div>La imagen debe tener menos de 1Mb.</div>";
							}
							// asegurarse de que exista la carpeta 'cargas'
							// en caso que no, crerla
							if(!is_dir($directorio_destino)){
								mkdir($directorio_destino, 0777, true);
							}
							
							// si $msj_error_carga_archivo sigue vacía
							if(empty($msj_error_carga_archivo)){
								// significa que no hay errores, así que se intenta cargar el archivo
								if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo_destino)){
									// significa que la foto fue subida
								}else{
									echo "<div class='alert alert-danger'>
										<div>No se puede cargar la foto.</div>
										<div>Actualizar el registro para subir la foto.</div>
									</div>";
								}
							}
							 
							// si $msj_error_carga_archivo No está vacía
							else{
								// significa que hay algunos errores, así que se muestra msj al usuario
								echo "<div class='alert alert-danger'>
									<div>{$msj_error_carga_archivo}</div>
									<div>Actualizar el registro para subir la foto.</div>
								</div>";
							}
						}
					}else{
						echo "<div class='alert-danger'>No se pudo guardar la receta.</div>";
					}			 
				}			 
				// Muestra el Error, si hubo
				catch(PDOException $excepcion){
					die('ERROR: ' . $excepcion->getMessage());
				}
			}
		?>
        <!-- Formulario html donde se cargará la información del producto -->
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <table class='formato-tabla'>
                <tr>
                    <td id="nombre-crear">Nombre:</td>
                    <td><input type='text' name='nombre' class='control-formulario' /></td>
                </tr>
                <tr>
                    <td id="ingredientes-crear">Ingredientes:</td>
                    <td><textarea name='ingredientes' class='control-formulario' cols="60" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td id="elaboracion-crear">Elaboracion:</td>
                    <td><textarea name='elaboracion' class='control-formulario' cols="60" rows="10" minlength="300"></textarea></td>
                </tr>
				<tr id="imagen-crear">
                    <td id="imagen-crear">Imagen:</td>
                    <td><input type="file" name="imagen" required/></td>
                </tr>
				<tr id="tipo-crear">
					<td>Tipo:</td>
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
				<tr id="region-crear">
					<td>Region:</td>
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
					<td id="crear-usuario">Usuario:</td>
					<td class="usuario-crear"><?php echo htmlspecialchars($usuario, ENT_QUOTES);?></td>
				</tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Guardar' class='boton-principal-crear' />
                        <a href='../index.php' class="boton-peligro-crear">Volver al Inicio</a>
                    </td>
                </tr>
            </table>
        </form>
    </div> <!-- Fin del contenedor -->
    <!-- Aquí va el código de acceso a archivo javascript --> 
    <script src="#"></script>
</body>
</html>