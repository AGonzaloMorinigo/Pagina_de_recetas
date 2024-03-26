<?php
echo "<ul class='paginacion avance-izq margen-cero'>";
// boton de primera pagina 
if($pag>1) {
    $prev_pag = $pag - 1;
    echo "<li>
    <a href='{$pag_url}pag={$prev_pag}'>
    <span style='margin:0 .5em;'>«</span>
    </a>
    </li>";
}
// numeros de pagina en los que se pueden hacer click 
// obtener paginas totales 
$total_pag = ceil($total_filas / $reg_por_pag);
// Rango de numeros con enlaces  mostrar
$rango = 1;
// mostrar enlaces a 'rango de paginas' alrededor de la 'pagina actual'
$inicial_num = $pag - $rango;
$condicion_limit_num = ($pag + $rango) + 1;
for ($x=$inicial_num; $x<$condicion_limit_num; $x++) {
    // nos aseguramos que '$x sea mayor que 0' Y 'menor o igual que $total_pag'
    if (($x > 0) && ($x <= $total_pag)) {
        //pagina actual
        if ($x == $pag) {
            echo "<li class='activa'>
            <a href='javascript::void(0);'>{$x}</a>
        </li>";
        
        }
        //pagina no actual 
        else {
            echo "<li>
            <a href='{$pag_url}pag={$x}'>{$x}</a>
            </li>"; 
        }
    }
}
// el boton de la ultima pagina ira aqui 
if ($pag<$total_pag){
    $prox_pag = $pag + 1;
    echo "<li>
    <a href='{$pag_url}pag={$prox_pag}'>
    <span style='margin:0 . 5em;'>»</span>
    </a>
    </li>";
}
echo "</ul>";
?>