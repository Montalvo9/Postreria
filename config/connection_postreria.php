<?php
require_once 'postreria.php';

class PostreriaConnection{
    static function ConnectionPostreria(){
        try{
            $dbpostreria = new PDO(DSN,USERPOSTRERIA, PASSWORD );
            return $dbpostreria;

        }catch(PDOException $error){
            die($error->getMessage());
        }
    }
}
?>