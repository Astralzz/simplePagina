<?php
// Incluir el archivo de la clase de control de datos
require_once 'Controlador.php';

// Todo, Clase para la conexión
class ControladorCliente extends Controlador
{

    // * Constructor
    public function __construct()
    {
        // Ejecutar el constructor padre
        parent::__construct();
    }

    // * Mostrar clientes
    public function getClientes()
    {

        // Lista de clientes
        $clientes = array();

        // Consulta
        $sql = "SELECT * FROM clientes";

        // resultado
        $res = $this->conn->query($sql);

        // Si tiene mas de 0
        if ($res->num_rows > 0) {
            // Recorremos
            while ($row = $res->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        return $clientes;
    }

    // * Agregar un nuevo cliente
    public function agregarCliente($nombre, $apellidos, $direccion, $empresa, $rfc)
    {
        // Escapar los valores para evitar inyección de SQL
        $nombre = $this->conn->real_escape_string($nombre);
        $apellidos = $this->conn->real_escape_string($apellidos);
        $direccion = $this->conn->real_escape_string($direccion);
        $empresa = $this->conn->real_escape_string($empresa);
        $rfc = $this->conn->real_escape_string($rfc);

        // Construir la consulta INSERT
        $sql = "INSERT INTO clientes (nombre, apellidos, direccion, empresa, RFC) VALUES ('$nombre', '$apellidos', '$direccion', '$empresa', '$rfc')";

        // Ejecutar la consulta
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al agregar el cliente: " . $this->conn->error;
            return false;
        }
    }

    // * Eliminar un cliente por su ID
    public function eliminarCliente($id)
    {
        // Escapar el valor del ID para evitar inyección de SQL
        $id = $this->conn->real_escape_string($id);

        // Construir la consulta DELETE
        $sql = "DELETE FROM clientes WHERE id = '$id'";

        // Ejecutar la consulta
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar el cliente: " . $this->conn->error;
            return false;
        }
    }
}
