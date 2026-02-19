<?php 
include_once './models/DBLogin.php'; 

class Login{
    private $modelo; 

    function __construct()
    {
        $this->modelo = new ModeloLogin(); //LLamamos al modelo ModeloLogin
    }

    function obtenerUsuario(){
        $modelo = new ModeloLogin(); 
        $dato = $modelo->ObtenerUsuarios();
        if($dato){
            return json_encode($dato); 
        }else{
            return "¡ERROR!";
        }
    }
}
?>