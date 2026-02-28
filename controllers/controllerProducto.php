<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/modeloProducto.php';

$db = new modeloProducto();
$opcion = $_POST['opcion'] ?? '';

switch ($opcion) {
    case 'lista-productos':
        $datos = $db->consulta();
        $lista = [];

        foreach ($datos as $value) {
            $lista[] = [
                "id" => $value["id_producto"],
                "nombre" => $value["nombre"],
                "descripcion" => $value["descripcion"],
                "precio" => $value["precio"],
                "stock" => $value["stock"],
                "categoria" => $value["nombre_categoria"],
                "activo" => $value["activo"],
                "fecha_creacion" => $value["fecha_creacion"],
                "accion" => "<div class='d-flex gap-1 justify-content-center'>
                             <button class='btn btn-sm btn-outline-primary' onclick='obtenerDatos({$value['id_producto']})'title='Editar'> <i class='fas fa-edit'></i> </button>

                            <button class='btn btn-sm btn-outline-danger' onclick='eliminarUsuario({$value['id_producto']})'  title='Eliminar'> <i class='fas fa-trash'></i> </button>
                             </div>"
            ];
        }
        echo json_encode(["data" => $lista]);
        exit;
        break;
    case "obtener-categoria": 
        $datos = $db->obtenerCategoria();
        header('Content-Type: application/json'); 
        echo json_encode($datos); 
        exit; 
        break;
    
    case 'insertar-producto':

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? ''); // Puede ir vacío
    $precio = trim($_POST['precio'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');

    // Validación obligatoria (descripcion NO se valida)
    if ($nombre === '' || $precio === '' || $stock === '' || $categoria === '') {
        echo json_encode([
            "status" => "error",
            "mensaje" => "Todos los campos excepto descripción son obligatorios"
        ]);
        exit;
    }

    $resultado = $db->insertarProducto($nombre, $descripcion, $precio, $stock, $categoria);

    if ($resultado) {
        echo json_encode([
            "status" => "success",
            "mensaje" => "Producto registrado correctamente"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "mensaje" => "Error al registrar producto"
        ]);
    }

    exit;
    break;
    default:
    echo json_encode(["data"=>[]]);
    
}
