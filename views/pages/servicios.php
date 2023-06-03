<?php

// Incluir el archivo de la clase de control de datos
require_once './php/ControladorServicio.php';
require_once './php/ControladorCliente.php';
require_once './php/ControladorVehiculos.php';

// Iniciamos
$controladorServicio = new ControladorServicio();
$controladorClientes = new ControladorCliente();
$controladorAutos = new ControladorVehiculos();

// * AGREGAR SERVICIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente']) && isset($_POST['id_vehiculo'])) {

    // Datos primarios
    $id_cliente = $_POST['id_cliente'];
    $id_vehiculo = $_POST['id_vehiculo'];
    $precio = $_POST['precio'];
    $fecha = $_POST['fecha'];
    $hora_salida = !$_POST['hora_salida']  || $_POST['hora_salida'] === '00:00:00' ? date('H:i:s') : $_POST['hora_salida'];
    $hora_entrada = !$_POST['hora_salida'] || $_POST['hora_entrada']  === '00:00:00' ?  date('H:i:s', strtotime('+30 minutes')) : $_POST['hora_entrada'];
    // Datos secundarios
    $id_categoria_lavado = $_POST['id_categoria_lavado'] ?? 1;
    $encerado = !isset($_POST['encerado']) || $_POST['encerado'] !== 'on' ? 0 : 1;
    $pulido = !isset($_POST['pulido']) || $_POST['pulido'] !== 'on' ? 0 : 1;
    $aspirado_cajuela = !isset($_POST['aspirado_cajuela']) || $_POST['aspirado_cajuela'] !== 'on' ? 0 : 1;
    $faros = !isset($_POST['faros']) || $_POST['faros'] !== 'on' ? 0 : 1;
    $aire_llantas = !isset($_POST['aire_llantas']) || $_POST['aire_llantas'] !== 'on' ? 0 : 1;
    $id_categoria_almorol = $_POST['id_categoria_almorol'] ?? 1;

    // ? Validar la fecha
    if (!$fecha || $fecha === '0000-00-00' || $fecha === '00/00/00') {
        $error_alert = 'La fecha no puede ser "0000-00-00".';
    } else {
        // ? Validar el precio
        if (!$precio || $precio <= 50) {
            $error_alert = 'El precio tiene que ser 50 o mas';
        } else {

            // Agregamos
            $agregado = $controladorServicio->agregarServicio(
                $id_cliente,
                $id_vehiculo,
                $precio,
                $fecha,
                $hora_salida,
                $hora_entrada,
                $id_categoria_lavado,
                $encerado,
                $pulido,
                $aspirado_cajuela,
                $faros,
                $aire_llantas,
                $id_categoria_almorol
            );

            // ? Se agrego?
            if ($agregado) {
                // * Redirigir o actualizar la página después de agregar el servicio
                header('Location: ' . "#");
                $exito_alert = 'Exito, el servicio se agrego correctamente';
                exit;
            }
        }
    }
}

// * ELIMINAR SERVICIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['servicio_id'])) {
    // Obtener el ID del servicio a eliminar
    $servicio_id = $_POST['servicio_id'];

    // Eliminar el servicio
    $eliminado = $controladorServicio->eliminarServicio($servicio_id);

    // ? Se elimino?
    if ($eliminado) {
        // * Redirigir o actualizar la página después de eliminar el servicio
        header('Location: ' . "#");
        exit;
    }
}

// Obtener servicios
$servicios = $controladorServicio->verServicios();
$categorias = $controladorServicio->verCategoriasServicio();
// Obtener clientes
$clientes = $controladorClientes->verClientes();
// Obtener autos
$vehiculos = $controladorAutos->verVehiculos();

?>

<!-- Cuerpo principal -->
<div class="container-fluid animar">
    <div class="row">
        <!-- Tabla de servicios - Columna izquierda -->
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="color-rosa text-white">
                    <tr>
                        <!-- Títulos -->
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Modelo</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Hora Entrada</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicios as $servicio) : ?>
                        <tr>
                            <!-- Columnas -->
                            <td><?php echo $servicio['id']; ?></td>
                            <td><?php echo $servicio['cliente_nombre']; ?></td>
                            <td><?php echo $servicio['modelo']; ?></td>
                            <td><?php echo $servicio['precio']; ?></td>
                            <td><?php echo $servicio['fecha']; ?></td>
                            <td><?php echo $servicio['hora_entrada']; ?></td>
                            <td>
                                <!-- Botón para ver los detalles -->
                                <button type="button" class="btn btn-primary btn-sm boton-animar" data-toggle="modal" data-target="#modal-<?php echo $servicio['id']; ?>">Detalles</button>

                                <!-- Formulario para eliminar -->
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                    <input type="hidden" name="servicio_id" value="<?php echo $servicio['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm boton-animar">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal para mostrar los detalles -->
                        <div class="modal fade" id="modal-<?php echo $servicio['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $servicio['id']; ?>-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-<?php echo $servicio['id']; ?>-label">Detalles del Servicio <?php echo $servicio['fecha']; ?></h5>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenido de los detalles del servicio -->
                                        <p><b>Cliente:</b> <?php echo $servicio['cliente_nombre']; ?></p>

                                        <!-- Auto -->
                                        <p>
                                            <b>Marca:</b> <?php echo $servicio['marca']; ?>
                                            - <b>Modelo:</b> <?php echo $servicio['modelo']; ?>
                                            - <b>Año:</b> <?php echo $servicio['anio']; ?>
                                            - <b>Color:</b> <?php echo $servicio['color']; ?>
                                            - <b>Precio:</b> <?php echo $servicio['precio']; ?>
                                        </p>

                                        <!-- Fecha -->
                                        <p><b>Fecha:</b> <?php echo $servicio['fecha']; ?></p>

                                        <!-- Horas -->
                                        <p>
                                            <b>Hora de salida:</b> <?php echo $servicio['hora_salida']; ?>
                                            -- <b>Hora de entrada:</b> <?php echo $servicio['hora_entrada']; ?>
                                        </p>

                                        <!-- Categorias -->
                                        <p>
                                            <b>Lavado:</b>
                                            <?php
                                            if ($servicio['id_categoria_lavado'] === 2) {
                                                echo 'interior';
                                            } elseif ($servicio['id_categoria_lavado'] === 3) {
                                                echo 'exterior';
                                            } else {
                                                echo 'ninguno';
                                            }
                                            ?>
                                            - <b>Almorol:</b>
                                            <?php
                                            if ($servicio['id_categoria_almorol'] === 2) {
                                                echo 'interior';
                                            } elseif ($servicio['id_categoria_almorol'] === 3) {
                                                echo 'exterior';
                                            } else {
                                                echo 'ninguno';
                                            } ?>
                                        </p>

                                        <!-- Datos de si o no -->
                                        <p>
                                            <span class="badge bg-<?php echo $servicio['encerado'] ? 'success' : 'danger'; ?>">
                                                Encerado
                                            </span>
                                            <span class="badge bg-<?php echo $servicio['pulido'] ? 'success' : 'danger'; ?>">
                                                Encerado
                                            </span>
                                            <span class="badge bg-<?php echo $servicio['aspirado_cajuela'] ? 'success' : 'danger'; ?>">
                                                Aspirado de cajuela
                                            </span>
                                            <span class="badge bg-<?php echo $servicio['faros'] ? 'success' : 'danger'; ?>">
                                                Faros
                                            </span>
                                            <span class="badge bg-<?php echo $servicio['aire_llantas'] ? 'success' : 'danger'; ?>">
                                                Arie en llantas
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario para agregar un nuevo servicio - Columna derecha -->
        <div class="col-md-4">
            <div class="my-7 bg-white p-4 rounded">
                <h3 class="text-center">Agregar Servicio</h3>
                <!-- Mostrar la alerta de error si existe -->
                <?php if (isset($error_alert)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error_alert; ?></div>
                <?php endif; ?>
                <!-- Mostrar la alerta de éxito si existe -->
                <?php if (isset($exito_alert)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error_alert; ?></div>
                <?php endif; ?>
                <!-- Formulario -->
                <form method="POST">

                    <!-- DATOS PRIMARIOS -->

                    <!-- Fila 1 -->
                    <div class="row">
                        <!-- Clientes -->
                        <div class="form-group col-md-4">
                            <label for="id_cliente">Cliente</label>
                            <select class="form-control" id="id_cliente" name="id_cliente" required>
                                <!-- Recorremos -->
                                <?php foreach ($clientes as $cliente) : ?>
                                    <option value="<?php echo $cliente['id']; ?>">
                                        <?php echo $cliente['id'] . ' - ' . $cliente['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Vehiculo -->
                        <div class="form-group col-md-4">
                            <label for="id_vehiculo">Vehiculo</label>
                            <select class="form-control" id="id_vehiculo" name="id_vehiculo" required>
                                <!-- Recorremos -->
                                <?php foreach ($vehiculos as $vehiculo) : ?>
                                    <option value="<?php echo $vehiculo['id']; ?>">
                                        <?php echo $vehiculo['id'] . ' - ' . $vehiculo['modelo']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Fecha -->
                        <div class="form-group col-md-4">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" require>
                        </div>
                    </div>

                    <!-- Fila 2 -->
                    <div class="row">
                        <!-- Hora de entrada -->
                        <div class="form-group col-md-4">
                            <label for="hora_entrada">Entrada</label>
                            <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
                        </div>
                        <!-- Hora de salida -->
                        <div class="form-group col-md-4">
                            <label for="hora_salida">Salida</label>
                            <input type="time" class="form-control" id="hora_salida" name="hora_salida">
                        </div>
                        <!-- Precio -->
                        <div class="form-group col-md-4">
                            <label for="precio">Precio</label>
                            <input minlength="2" type="number" class="form-control" id="precio" name="precio" require>
                        </div>
                    </div>
                    <br>

                    <!-- DATOS SECUNDARIOS -->
                    <h5 for="encerado">Detalles</h5>

                    <!-- Fila 3 -->
                    <div class="row">
                        <!-- Lavado -->
                        <div class="form-group col-md-6">
                            <label for="id_categoria_lavado">Categoria de lavado</label>
                            <select class="form-control" id="id_categoria_lavado" name="id_categoria_lavado" required>
                                <!-- Recorremos -->
                                <?php foreach ($categorias as $categoria) : ?>
                                    <option value="<?php echo $categoria['id']; ?>">
                                        <?php echo $categoria['id'] . ' - ' . $categoria['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Almorol -->
                        <div class="form-group col-md-6">
                            <label for="id_categoria_almorol">Categoria del almorol</label>
                            <select class="form-control" id="id_categoria_almorol" name="id_categoria_almorol" required>
                                <!-- Recorremos -->
                                <?php foreach ($categorias as $categoria) : ?>
                                    <option value="<?php echo $categoria['id']; ?>">
                                        <?php echo $categoria['id'] . ' - ' . $categoria['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <!-- Fila 4 -->
                    <div class="row">
                        <!-- Encerado -->
                        <div class="form-check col-md-4">
                            <input class="form-check-input" type="checkbox" id="encerado" name="encerado">
                            <label class="form-check-label" for="encerado">Encerado</label>
                        </div>
                        <!-- Pulido -->
                        <div class="form-check col-md-4">
                            <input class="form-check-input" type="checkbox" id="pulido" name="pulido">
                            <label class="form-check-label" for="pulido">Pulido</label>
                        </div>
                        <!-- Faros -->
                        <div class="form-check col-md-4">
                            <input class="form-check-input" type="checkbox" id="faros" name="faros">
                            <label class="form-check-label" for="faros">Faros</label>
                        </div>
                    </div>

                    <!-- Fila 5 -->
                    <div class="row">
                        <!-- Cajuela aspirada -->
                        <div class="form-check col-md-5">
                            <input class="form-check-input" type="checkbox" id="aspirado_cajuela" name="aspirado_cajuela">
                            <label class="form-check-label" for="aspirado_cajuela">Cajuela aspirada</label>
                        </div>
                        <!-- Aire en las llantas -->
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="checkbox" id="aire_llantas" name="aire_llantas">
                            <label class="form-check-label" for="aire_llantas">Aire en las llantas</label>
                        </div>
                    </div>

                    <!-- Botón para agregar -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn color-rosa text-white mt-3 boton-animar">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>