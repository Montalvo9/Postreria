<?php
require_once 'postreria.php';

class PostreriaConnection{
    static function ConnectionPostreria(){
        // Traemos la variable $options que está definida en postreria.php
        global $options; 

        try{
            // Agregamos $options como cuarto parámetro
            $dbpostreria = new PDO(DSN, USERPOSTRERIA, PASSWORD, $options);
            return $dbpostreria;

        }catch(PDOException $error){
            die("Error de conexión: " . $error->getMessage());
        }
    }
}
?>