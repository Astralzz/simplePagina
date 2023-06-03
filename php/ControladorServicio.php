<?php
require_once 'Controlador.php';

// todo, Controlador del servicio
class ControladorServicio extends Controlador
{
    // * Constructor
    public function __construct()
    {
        // * Constructor padre
        parent::__construct();
    }

    // * Mostrar servicios
    public function verServicios()
    {
        $servicios = array();
        // Obtenemos los datos
        $sql = "SELECT s.id, c.id AS cliente_id, c.nombre AS cliente_nombre, v.id AS vehiculo_id, v.marca, v.modelo, v.anio, v.color, s.precio, s.fecha, s.hora_salida, s.hora_entrada,
                ds.id_categoria_lavado, ds.encerado, ds.pulido, ds.aspirado_cajuela, ds.faros, ds.aire_llantas, ds.id_categoria_almorol
                FROM servicio s
                INNER JOIN clientes c ON s.id_cliente = c.id
                INNER JOIN vehiculos v ON s.id_vehiculo = v.id
                INNER JOIN detalle_servicio ds ON s.id = ds.id_servicio";
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $servicios[] = $row;
            }
        }

        return $servicios;
    }

    // * Mostrar categorías de servicio
    public function verCategoriasServicio()
    {
        $categorias = array();
        $sql = "SELECT * FROM categoria_servicio";
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $categorias[] = $row;
            }
        }

        return $categorias;
    }

    // * Agregar una nueva categoría de servicio
    public function agregarCategoriaServicio($nombre)
    {
        $nombre = $this->conn->real_escape_string($nombre);

        // Agregamos
        $sql = "INSERT INTO categoria_servicio (nombre) VALUES ('$nombre')";

        // ? Se agrego? 
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            // ! Error
            echo "Error al agregar la categoría de servicio: " . $this->conn->error;
            return false;
        }
    }

    // * Agregar un nuevo servicio
    public function agregarServicio($id_cliente, $id_vehiculo, $precio, $fecha, $hora_salida, $hora_entrada, $id_categoria_lavado, $encerado, $pulido, $aspirado_cajuela, $faros, $aire_llantas, $id_categoria_almorol)
    {
        $id_cliente = $this->conn->real_escape_string($id_cliente);
        $id_vehiculo = $this->conn->real_escape_string($id_vehiculo);
        $precio = $this->conn->real_escape_string($precio);
        $fecha = $this->conn->real_escape_string($fecha);
        $hora_salida = $this->conn->real_escape_string($hora_salida);
        $hora_entrada = $this->conn->real_escape_string($hora_entrada);
        $id_categoria_lavado = $this->conn->real_escape_string($id_categoria_lavado);
        $encerado = $this->conn->real_escape_string($encerado);
        $pulido = $this->conn->real_escape_string($pulido);
        $aspirado_cajuela = $this->conn->real_escape_string($aspirado_cajuela);
        $faros = $this->conn->real_escape_string($faros);
        $aire_llantas = $this->conn->real_escape_string($aire_llantas);
        $id_categoria_almorol = $this->conn->real_escape_string($id_categoria_almorol);

        // Iniciar una transacción
        $this->conn->begin_transaction();

        // Insertar en la tabla 'servicio'
        $sql_servicio = "INSERT INTO servicio (id_cliente, id_vehiculo, precio, fecha, hora_salida, hora_entrada) VALUES ('$id_cliente', '$id_vehiculo', '$precio', '$fecha', '$hora_salida', '$hora_entrada')";

        // ? Se agrego ?
        if ($this->conn->query($sql_servicio) === TRUE) {
            $id_servicio = $this->conn->insert_id;

            // Insertar en la tabla 'detalle_servicio'
            $sql_detalle = "INSERT INTO detalle_servicio (id_servicio, id_categoria_lavado, encerado, pulido, aspirado_cajuela, faros, aire_llantas, id_categoria_almorol) VALUES ('$id_servicio', '$id_categoria_lavado', '$encerado', '$pulido', '$aspirado_cajuela', '$faros', '$aire_llantas', '$id_categoria_almorol')";

            // ? Se agrego ?
            if ($this->conn->query($sql_detalle) === TRUE) {
                // Confirmar la transacción si ambos INSERT se completaron correctamente
                $this->conn->commit();
                return true;
            } else {
                // ! Revertir la transacción si hay un error en el INSERT de 'detalle_servicio'
                $this->conn->rollback();
                echo "Error al agregar el detalle del servicio: " . $this->conn->error;
                return false;
            }
        } else {
            // ! Revertir la transacción si hay un error en el INSERT de 'servicio'
            $this->conn->rollback();
            echo "Error al agregar el servicio: " . $this->conn->error;
            return false;
        }
    }

    // * Eliminar una categoría de servicio por su ID
    public function eliminarCategoriaServicio($id)
    {
        $id = $this->conn->real_escape_string($id);

        $sql = "DELETE FROM categoria_servicio WHERE id = '$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar la categoría de servicio: " . $this->conn->error;
            return false;
        }
    }

    // * Eliminar servicio
    public function eliminarServicio($id)
    {
        $id = $this->conn->real_escape_string($id);

        // Iniciar la transacción
        $this->conn->begin_transaction();

        try {
            // Eliminar el servicio
            $sql = "DELETE FROM servicio WHERE id = '$id'";
            $this->conn->query($sql);

            // Eliminar los registros de detalle_servicio asociados al servicio
            $sql = "DELETE FROM detalle_servicio WHERE id_servicio = '$id'";
            $this->conn->query($sql);

            // Completar la transacción
            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $this->conn->rollback();
            echo "Error al eliminar el servicio: " . $e->getMessage();
            return false;
        }
    }
}
