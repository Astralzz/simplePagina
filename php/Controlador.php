<?php
// Todo, Clase para la conexión
class Controlador
{

    // * Datos para la conexión
    protected $servidor = "localhost";
    protected $usuario = "root";
    protected $password = "";
    protected $base_datos = "lavado_autos";
    protected $conn;

    // * Constructor
    public function __construct()
    {
        // Creamos conexión
        $this->conn = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);
        // Si da error
        if ($this->conn->connect_error) {
            die("Error en la conexión: " . $this->conn->connect_error);
        }
    }

    // * Cerrar la conexión a la base de datos
    public function cerrarConexion()
    {
        $this->conn->close();
    }
}
