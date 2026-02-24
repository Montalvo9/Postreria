<?php

include_once('../config/connection_postreria.php'); 

class modeloUsuario{
    private $modelo; //Lo usare para datos temporales, resultados de consultas, o estructuras que la clase va a manipular
    private $db; 

    public function __construct()
    {
        $this->modelo = array(); 
        $this->db = PostreriaConnection::ConnectionPostreria();
    }

    /**Funcion que consulta a los usuarios existentes en la bd para mostrarlos en el frontend con un DataTable */

    public function consulta(){
        $this->modelo = []; //limpiamos antes de cada consulta
        $query = $this->db->prepare("SELECT id_usuario, nombre, usuario, rol, activo, fecha_creacion from usuarios");
        $query->execute(); 
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }
}

?>