<?php
// Ruta global
$RUTA_GLOBAL = "/appWeb_1/";
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Titulo -->
    <title>Lavado de Autos</title>
    <!-- Icono global de la página -->
    <link rel="icon" href="./imgs/imgAvatar.png">
    <!-- Archivos CSS y JS de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script><!-- Agrega los estilos de Bootstrap -->
</head>

<body>
    <!-- Narval -->
    <nav class="navbar navbar-expand-lg navbar-dark color-rosa">
        <div class="container-fluid">
            <!-- Titulo izquierdo -->
            <a class="navbar-brand" href="#">Mi sitio web </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Pestañas -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Inicio -->
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == $RUTA_GLOBAL . "?pag=inicio") echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=inicio"; ?>">
                            <span class="glyphicon glyphicon-user"></span> Inicio
                        </a>
                    </li>
                    <!-- Clientes -->
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == $RUTA_GLOBAL . "?pag=usuarios") echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=usuarios"; ?>">
                            <span class="glyphicon glyphicon-user"></span> Clientes
                        </a>
                    </li>
                    <!-- Vehiculos -->
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == $RUTA_GLOBAL . "?pag=autos") echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=autos"; ?>">
                            <span class="glyphicon glyphicon-road"></span> Autos
                        </a>
                    </li>
                    <!-- Servicios -->
                    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == $RUTA_GLOBAL . "?pag=servicios") echo 'active'; ?>">
                        <a class="nav-link" href="<?php echo $RUTA_GLOBAL . "?pag=servicios"; ?>">
                            <span class="glyphicon glyphicon-road"></span> Servicios
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>