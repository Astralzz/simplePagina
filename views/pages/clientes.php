<?php

// Incluir el archivo de la clase de control de datos
require_once './php/ControladorCliente.php';

// Crear una instancia de la clase de control de datos
$controlador = new ControladorCliente();

// * AGREGAR CLIENTE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $empresa = $_POST['empresa'];
    $rfc = $_POST['rfc'];

    // Realizar las validaciones necesarias antes de guardar en la base de datos

    // Agregar el nuevo cliente
    $agregado = $controlador->agregarCliente($nombre, $apellidos, $direccion, $empresa, $rfc);

    // ? Se agrego?
    if ($agregado) {
        // Redirigir o actualizar la página después de agregar el cliente
        header('Location: ' . "#");
        exit;
    }
}

// * ELIMINAR CLIENTE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente_id'])) {
    // Obtener el ID del cliente a eliminar
    $cliente_id = $_POST['cliente_id'];

    // Eliminar el cliente
    $eliminado = $controlador->eliminarCliente($cliente_id);

    // ? Se elimino?
    if ($eliminado) {
        // Redirigir o actualizar la página después de eliminar el cliente
        header('Location: ' . "#");
        exit;
    }
}

// Obtenemos clientes
$clientes = $controlador->getClientes();

?>

<div class="container-fluid animar">
    <div class="row">
        <!-- Tabla de clientes - Columna izquierda -->
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="color-rosa text-white">
                    <tr>
                        <!-- Títulos -->
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Empresa</th>
                        <th>RFC</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <!-- Columnas -->
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['nombre']; ?></td>
                            <td><?php echo $cliente['apellidos']; ?></td>
                            <td><?php echo $cliente['direccion']; ?></td>
                            <td><?php echo $cliente['empresa']; ?></td>
                            <td><?php echo $cliente['RFC']; ?></td>
                            <td>
                                <!-- Botón eliminar -->
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                    <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm boton-animar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario para agregar un nuevo cliente - Columna derecha -->
        <div class="col-md-4">
            <div class="my-7 bg-white p-4 rounded">
                <h3 class="text-center">Agregar Cliente</h3>
                <form method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" id="rfc" name="rfc">
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