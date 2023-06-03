<?php
// Obtener la ruta actual
$ruta = $_SERVER['REQUEST_URI'];

// ? Index?
if ($ruta == $RUTA_GLOBAL || $ruta == $RUTA_GLOBAL . "?pag=inicio") {
    include './views/pages/inicio.php';
    // ? Clientes?
} elseif ($ruta == $RUTA_GLOBAL . "?pag=usuarios") {
    include './views/pages/clientes.php';
    // ? Vehiculos?
} elseif ($ruta ==  $RUTA_GLOBAL . "?pag=autos") {
    include './views/pages/autos.php';
    // ? Servicios?
} elseif ($ruta ==  $RUTA_GLOBAL . "?pag=servicios") {
    include './views/pages/servicios.php';
    // ? Otras ?
} else {
    echo '<h1>Página no encontrada</h1>';
    echo '<p>La página solicitada no existe.</p>';
}
