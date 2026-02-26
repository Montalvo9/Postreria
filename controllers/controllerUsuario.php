<?php
header('Content-Type: application/json');


require_once __DIR__ . '/../models/modeloUsuario.php';

$db = new modeloUsuario();

$opcion = $_POST['opcion'] ?? '';

switch ($opcion) {
    case 'lista-usuarios':
        $datos = $db->consulta();
        $lista = [];

        foreach ($datos as $value) {
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
    case 'insertar-usuarios':
        $nombre = $_POST['nombre'] ?? '';
        $usuario = $_POST['usuario'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol = $_POST['rol'] ?? '';

        $resultado = $db->insertarUsuario($nombre, $usuario, $password, $rol);
        echo $resultado ? 1 : 0;
        exit;
        break;
    case 'obtenerDatosUsuario':
        $id = $_POST['idusuario'];
        $datos = $db->obtenerDatosUsuario($id);
        // Mandamos los datos como JSON para que el modal los pueda "leer" y mostrar
        header('Content-Type: application/json');
        echo json_encode($datos);
        exit;
        break;
    case 'editar-usuario':
        $datos = $db->editarUsuario($_POST['id'], $_POST['nombre'], $_POST['usuario'], $_POST['password'], $_POST['rol'], $_POST['estado']);
        echo $datos ? 1 : 0;
        exit;
        break;
    case 'eliminar-usuario':
        $id = $_POST['idusuario'];
        $datos = $db->eliminarUsuario($id);
        echo $datos ? 1 :0 ;
        exit;
        break;
        
}
