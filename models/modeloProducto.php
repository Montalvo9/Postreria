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
        WHERE p.activo = 1
    ");

        $query->execute();
        $this->modelo = $query->fetchAll(PDO::FETCH_ASSOC);

        return $this->modelo;
    }
}
