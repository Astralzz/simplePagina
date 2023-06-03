<?php
// Incluir el archivo de la clase de control de datos
require_once './php/ControladorVehiculos.php';

// Crear una instancia de la clase de control de datos
$controlador = new ControladorVehiculos();

// AGREGAR VEHÍCULO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marca'])) {
    // Obtener los datos del formulario
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $color = $_POST['color'];
    $noPuertas = $_POST['noPuertas'];
    $placa = $_POST['placa'];
    $observaciones = $_POST['observaciones'];

    // Realizar las validaciones necesarias antes de guardar en la base de datos

    // Agregar el nuevo vehículo
    $agregado = $controlador->agregarVehiculo($marca, $modelo, $anio, $color, $noPuertas, $placa, $observaciones);

    // ¿Se agregó?
    if ($agregado) {
        // Redirigir o actualizar la página después de agregar el vehículo
        header('Location: ' . "#");
        exit;
    }
}

// ELIMINAR VEHÍCULO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vehiculo_id'])) {
    // Obtener el ID del vehículo a eliminar
    $vehiculo_id = $_POST['vehiculo_id'];

    // Eliminar el vehículo
    $eliminado = $controlador->eliminarVehiculo($vehiculo_id);

    // ¿Se eliminó?
    if ($eliminado) {
        // Redirigir o actualizar la página después de eliminar el vehículo
        header('Location: ' . "#");
        exit;
    }
}

// Obtener vehículos
$vehiculos = $controlador->verVehiculos();

?>

<div class="container-fluid animar">
    <div class="row">
        <!-- Tabla de vehículos - Columna izquierda -->
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="color-rosa text-white">
                    <tr>
                        <!-- Títulos -->
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>No. Puertas</th>
                        <th>Placa</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorremos -->
                    <?php foreach ($vehiculos as $vehiculo) : ?>
                        <tr>
                            <!-- Columnas -->
                            <td><?php echo $vehiculo['id']; ?></td>
                            <td><?php echo $vehiculo['marca']; ?></td>
                            <td><?php echo $vehiculo['modelo']; ?></td>
                            <td><?php echo $vehiculo['anio']; ?></td>
                            <td><?php echo $vehiculo['color']; ?></td>
                            <td><?php echo $vehiculo['noPuertas']; ?></td>
                            <td><?php echo $vehiculo['placa']; ?></td>
                            <td><?php echo $vehiculo['observaciones']; ?></td>
                            <td>
                                <!-- Botón eliminar -->
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este vehículo?');">
                                    <input type="hidden" name="vehiculo_id" value="<?php echo $vehiculo['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm boton-animar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario para agregar un nuevo vehículo - Columna derecha -->
        <div class="col-md-4">
            <div class="my-7 bg-white p-4 rounded">
                <h3 class="text-center">Agregar Vehículo</h3>
                <form method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="anio">Año</label>
                            <input type="text" class="form-control" id="anio" name="anio">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="noPuertas">No. Puertas</label>
                            <input type="text" class="form-control" id="noPuertas" name="noPuertas">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" id="placa" name="placa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                        </div>
                    </div>
                    <!-- Botón para agregar -->
                    <div class="row">
                        <div class="form-group text-center">
                            <button type="submit" class="btn color-rosa text-white mt-3 boton-animar">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>