<?php
require_once './config/connection_postreria.php';

class ModeloLogin
{
    private $modeloLogin;
    private $dbLogin;

    public function __construct()
    {
        $this->modeloLogin = array();
        $this->dbLogin = PostreriaConnection::ConnectionPostreria();
    }

    /**La siguiente funcion obtiene todos usuarios en la tabla de la bd  */

    public function ObtenerUsuarios()
    {
        $query = $this->dbLogin->prepare("SELECT * FROM usuarios");
        $query->execute();
        /*
        while($filas = $query->fetch(PDO::FETCH_ASSOC)){
            $this->modeloLogin[] = $filas;



            - Con while + fetch(): vas trayendo fila por fila y las vas acumulando en el arreglo.
              - Con fetchAll(): obtienes directamente un arreglo con todas las filas en una sola llamada.

        }*/
        $this->modeloLogin = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->modeloLogin;
    }
}
