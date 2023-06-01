<?php
// Incluir el archivo de la clase de control de datos
require_once 'Controlador.php';

// Clase para la conexión
class ControladorVehiculos extends Controlador
{

    // Constructor
    public function __construct()
    {
        // Ejecutar el constructor padre
        parent::__construct();
    }

    // Mostrar vehículos
    public function getVehiculos()
    {
        // Lista de vehículos
        $vehiculos = array();

        // Consulta
        $sql = "SELECT * FROM vehiculos";

        // Resultado
        $res = $this->conn->query($sql);

        // Si tiene más de 0
        if ($res->num_rows > 0) {
            // Recorremos
            while ($row = $res->fetch_assoc()) {
                $vehiculos[] = $row;
            }
        }

        return $vehiculos;
    }

    // Agregar un nuevo vehículo
    public function agregarVehiculo($marca, $modelo, $anio, $color, $noPuertas, $placa, $observaciones)
    {
        // Escapar los valores para evitar inyección de SQL
        $marca = $this->conn->real_escape_string($marca);
        $modelo = $this->conn->real_escape_string($modelo);
        $anio = $this->conn->real_escape_string($anio);
        $color = $this->conn->real_escape_string($color);
        $noPuertas = $this->conn->real_escape_string($noPuertas);
        $placa = $this->conn->real_escape_string($placa);
        $observaciones = $this->conn->real_escape_string($observaciones);

        // Construir la consulta INSERT
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, color, noPuertas, placa, observaciones) VALUES ('$marca', '$modelo', '$anio', '$color', '$noPuertas', '$placa', '$observaciones')";

        // Ejecutar la consulta
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al agregar el vehículo: " . $this->conn->error;
            return false;
        }
    }

    // Eliminar un vehículo por su ID
    public function eliminarVehiculo($id)
    {
        // Escapar el valor del ID para evitar inyección de SQL
        $id = $this->conn->real_escape_string($id);

        // Construir la consulta DELETE
        $sql = "DELETE FROM vehiculos WHERE id = '$id'";

        // Ejecutar la consulta
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar el vehículo: " . $this->conn->error;
            return false;
        }
    }
}
