<?php
// Obtener la ruta actual
$ruta = $_SERVER['REQUEST_URI'];
// echo $ruta;

// Index
if ($ruta == $RUTA_GLOBAL) {
    echo '<h1>Inicio</h1>';
    // Clientes
} elseif ($ruta == $RUTA_GLOBAL . "?pag=usuarios") {
    include './views/pages/clientes.php';
    // Autos
} elseif ($ruta ==  $RUTA_GLOBAL . "?pag=autos") {
    include './views/pages/autos.php';
    // Otras
} else {
    echo '<h1>Página no encontrada</h1>';
    echo '<p>La página solicitada no existe.</p>';
}
