<?php 
header('Content-Type: application/json');


require_once __DIR__ . '/../models/modeloUsuario.php'; 

$db = new modeloUsuario(); 

$opcion = $_POST['opcion'] ?? ''; 

switch($opcion){
    case 'lista-usuarios': 
        $datos = $db->consulta();
        $lista = [];
        
        foreach($datos as $value){
             $lista[] = [
                "id" => $value["id_usuario"],
                "nombre" => $value["nombre"],
                "usuario" => $value["usuario"],
                "rol" => $value["rol"],
                "activo" => $value["activo"],
                "fechacreacion" => $value["fecha_creacion"],
                "accion" => "<div class='d-flex gap-1 justify-content-center'>
                             <button class='btn btn-sm btn-outline-primary' onclick='obtenerDatos({$value['id_usuario']})'title='Editar'> <i class='fas fa-edit'></i> </button>

                            <button class='btn btn-sm btn-outline-danger' onclick='eliminarUsuario({$value['id_usuario']})'  title='Eliminar'> <i class='fas fa-trash'></i> </button>
                             </div>
"
            ];
        }
        echo json_encode(["data" => $lista]);
        exit; 
        break;
}

?>