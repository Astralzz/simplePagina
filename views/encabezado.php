<?php
// Ruta global
$RUTA_GLOBAL = "/appWeb_1/";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Base de Datos de Lavado de Autos</title>
    <!-- Agrega los enlaces a los archivos CSS y JS de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">

</head>

<body>
    <!-- Narval -->
    <nav class="navbar navbar-expand-lg navbar-dark color-rosa">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi sitio web, </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == $RUTA_GLOBAL . "?pag=usuarios") echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=usuarios"; ?>">
                            <span class="glyphicon glyphicon-user"></span> Clientes
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/') echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=autos"; ?>">
                            <span class="glyphicon glyphicon-road"></span> Autos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>