<?php

include_once('../config/connection_postreria.php');

class modeloCategorias

{
    private $modelo; //Lo usare para datos temporales, resultados de consultas, o estructuras que la clase va a manipular
    private $db;

    public function __construct()
    {
        $this->modelo = array();
        $this->db = PostreriaConnection::ConnectionPostreria();
    }

    /**Funcion que consulta a los cas categorias existentes en la bd para mostrarlos en el frontend con un DataTable */

    public function consulta()
    {
        $this->modelo = []; //limpiamos antes de cada consulta
        $query = $this->db->prepare("SELECT id_categoria, nombre, icono, activo, fecha_creacion from categorias");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 
     * 
     */

    public function insertarCategoria($nombre, $icono)
    {
        try {
            $query = $this->db->prepare("
            INSERT INTO categorias (nombre, icono)
            VALUES (:nombre, :icono)
        ");

            $query->execute([
                ':nombre' => $nombre,
                ':icono' => $icono
            ]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function obtenerDatosCategoria($id)
    {
        //Preparamos la consulta con un marcador de posición (?) por seguridad de los datos
        $query = $this->db->prepare("SELECT id_categoria, nombre, icono, activo FROM categorias WHERE id_categoria = ?");
        //ejecutamos la consulta 
        $query->execute([$id]);

        /**Como solo esperamos un resultado , usamos fecth() directamente si while */
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function editarCategoria($id, $nombre, $icono, $activo){
        try{
            $consulta = "UPDATE categorias
                    SET nombre = :nombre,
                        icono = :icono,
                        activo = :activo
                    WHERE id_categoria = :id
                     ";

            $query = $this->db->prepare($consulta); 

            //vinculamos los datos
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(":icono", $icono); 
            $query->bindParam(":activo", $activo, PDO::PARAM_INT);
            $query->bindParam(":id", $id, PDO::PARAM_INT);

            return $query->execute();

        }catch(PDOException $error){
            return false;
        }
    }
}

?>