<?php
include_once('../config/connection_postreria.php');

class modeloProducto
{
    private $modelo;
    private $db;

    public function __construct()
    {
        $this->modelo = array();
        $this->db = PostreriaConnection::ConnectionPostreria();
    }

    /**Funcion que consulta a los usuarios existentes en la bd para mostrarlos en el frontend con un DataTable */
    public function consulta()
    {
        $this->modelo = [];

        $query = $this->db->prepare("
        SELECT 
            p.id_producto,
            p.nombre,
            p.descripcion,
            p.precio,
            p.stock,
            c.nombre AS nombre_categoria,
            p.activo,
            p.fecha_creacion
        FROM productos p
        INNER JOIN categorias c 
            ON p.categoria = c.id_categoria
        
    ");

        $query->execute();
        $this->modelo = $query->fetchAll(PDO::FETCH_ASSOC);

        return $this->modelo;
    }


    public function obtenerCategoria()
    {
        try {
            $query = $this->db->prepare("SELECT id_categoria, nombre FROM categorias WHERE activo = 1");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function insertarProducto($nombre, $descripcion, $precio, $stock, $id_categoria)
    {
        try {
            $query = $this->db->prepare("INSERT INTO productos(nombre, descripcion, precio, stock, categoria)
                                        VALUES(:nombre,:descripcion,:precio,:stock,:categoria)");
            $query->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,
                ':stock' => $stock,
                ':categoria' => $id_categoria
            ]);
            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    /**Funcion obtener datos para que se pinten en el modal y sea mas facil editar solo algunas cosas 
     * y no editar todos los campos
     */
    public function obtenerDatosProducto($id)
    {
        /**Preparamos la consulta para traer los datos */
        $query = $this->db->prepare("SELECT id_producto, nombre, descripcion, precio, stock, categoria, activo
                                         FROM productos WHERE id_producto = ? ");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**Funcion para actualizar producto */
    public function editarProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $activo)
    {
        try {
            $query = $this->db->prepare(
                "UPDATE productos
            SET nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                stock = :stock, 
                categoria = :categoria,
                activo = :activo
                WHERE id_producto = :id"
            );

            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':descripcion', $descripcion);
            $query->bindParam(':precio', $precio);
            $query->bindParam(':stock', $stock);
            $query->bindParam(':categoria', $categoria);
            $query->bindParam(':activo', $activo, PDO::PARAM_INT);
            $query->bindParam(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $error) {
            return false;
        }
    }

    public function eliminarProducto($id){
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?"); 
        $resultado = $query->execute([$id]);

        return $resultado;
    }
}
