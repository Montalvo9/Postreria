<?php

header('Content-Type: application/json'); // Indicamos que la respuesta será en formato JSON

require_once __DIR__ . '/../models/modeloCategorias.php';

$db = new modeloCategorias();

$opcion = $_POST['opcion'] ?? '';

switch ($opcion) {
    case 'lista-categorias':
        $datos = $db->consulta();
        $lista = [];

        foreach ($datos as $value) {
            $lista[] = [
                "id" => $value["id_categoria"],
                "nombre" => $value["nombre"],
                "icono" => $value["icono"],
                "activo" => $value["activo"],
                "fechacreacion" => $value["fecha_creacion"],
                "accion" => "<div class='d-flex gap-1 justify-content-center'>
                             <button class='btn btn-sm btn-outline-primary' onclick='obtenerDatos({$value['id_categoria']})'title='Editar'> <i class='fas fa-edit'></i> </button>

                            <button class='btn btn-sm btn-outline-danger' onclick='eliminarCategoria({$value['id_categoria']})'  title='Eliminar'> <i class='fas fa-trash'></i> </button>
                             </div>"
            ];
        }
        echo json_encode(["data" => $lista]);
        exit;
        break;

    case 'insertar-categoria':
        $nombre = trim($_POST['nombre'] ?? '');
        $icono = trim($_POST['icono'] ?? '');

        // Validación obligatoria
        if ($nombre === '') {
            echo json_encode([
                "status" => "error",
                "mensaje" => "El nombre de la categoría es obligatorio"
            ]);
            exit;
        }

        $resultado = $db->insertarCategoria($nombre, $icono);

        if ($resultado) {
            echo json_encode([
                "status" => "success",
                "mensaje" => "Categoría registrada correctamente"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error al registrar la categoría"
            ]);
        }
        break;

    case 'obtenerDatos-categoria':
        $id = $_POST['idcategoria'];
        $datos = $db->obtenerDatosCategoria($id);
        echo json_encode($datos);
        exit;
        break;

    case 'editar-categoria':
        $id = $_POST['idCategoria'] ?? ''; 
        $nombre = $_POST['nombre'] ?? ''; 
        $icono = $_POST['icono'] ?? ''; 
        $estado = $_POST['estado'] ?? ''; 


        //Validacion obligatoria para que se llenen los campos a exepción de (icono), esta ultima puede ir vacio

        if($nombre === '' || $estado === ''){
            echo json_encode([
                "status" => "error",
                "mensaje" => "Todos los campos icono son obligatorios"
            ]);
            exit;
        }

        $resultado = $db->editarCategoria($id, $nombre,$icono,$estado); 
        if($resultado){
            echo json_encode([
                "status" => "success",
                "mensaje"=> "Categoria editada correctamente"
            ]);
        }else{
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error al editar la categoria"
            ]);

        }
        exit;
        break;
    default:
        echo json_encode(["data" => []]);
        exit;
}
