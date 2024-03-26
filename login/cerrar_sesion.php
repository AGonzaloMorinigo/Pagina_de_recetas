<?php 
session_start();
session_destroy();
header("Location: /recetas_de_cocina_prueba/login/login.php");
exit();
?>