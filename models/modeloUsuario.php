<?php

include_once('../config/connection_postreria.php');

class modeloUsuario
{
    private $modelo; //Lo usare para datos temporales, resultados de consultas, o estructuras que la clase va a manipular
    private $db;

    public function __construct()
    {
        $this->modelo = array();
        $this->db = PostreriaConnection::ConnectionPostreria();
    }

    /**Funcion que consulta a los usuarios existentes en la bd para mostrarlos en el frontend con un DataTable */

    public function consulta()
    {
        $this->modelo = []; //limpiamos antes de cada consulta
        $query = $this->db->prepare("SELECT id_usuario, nombre, usuario, rol, activo, fecha_creacion from usuarios");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**Funcion para editarUsuario 
     * 
     */

    public function insertarUsuario($nombre, $usuario, $password, $rol)
    {
        try {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = $this->db->prepare("
            INSERT INTO usuarios (nombre, usuario, password, rol)
            VALUES (:nombre, :usuario, :password, :rol)
        ");

            $query->execute([
                ':nombre' => $nombre,
                ':usuario' => $usuario,
                ':password' => $password_hash,
                ':rol' => $rol
            ]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function obtenerDatosUsuario($id){
        //Preparamos la consulta con un marcador de posición (?) por seguridad de los datos
        $query = $this->db->prepare("SELECT id_usuario, nombre, usuario, activo FROM usuarios WHERE id_usuario = ?"); 
        //ejecutamos la consulta 
        $query->execute([$id]); 

        /**Como solo esperamos un resultado , usamos fecth() directamente si while 
         * PDO::FETCH_ASSOC nos devuelve ub objeto y no un arreglo 
         * 
         */
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
