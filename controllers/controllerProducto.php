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

                            <button class='btn btn-sm btn-outline-danger' onclick='eliminarProducto({$value['id_producto']})'  title='Eliminar'> <i class='fas fa-trash'></i> </button>
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

    case 'obtener-datos-producto':
        //Atrapamos el id que viene del ajax , el que se guarda en el hidden del formulario
        $id = $_POST['id_producto'];

        //llamamos al modelo
        $datos = $db->obtenerDatosProducto($id);

        //mandamos los datos en json para que el modal los pueda leer y mostrar
        echo json_encode($datos);
        exit;
        break;
    case 'editar-producto':
        $id = $_POST['id_producto'] ?? '';   //lo id-producto es el nombre de la prpiedad del objeto que creeare en js.
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';  //Este puede ir vacio o null a la bd
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $activo = $_POST['activo'] ?? '';

        // Validación obligatoria (descripcion NO se valida) los mando en json al ajax
        if ($nombre === '' || $precio === '' || $stock === '' || $categoria === '' || $activo === '') {

            echo json_encode([
                "status" => "error",
                "mensaje" => "Todos los campos excepto descripción son obligatorios"
            ]);


            exit;
        }
        $resultado = $db->editarProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $activo);

        if ($resultado) {
            echo json_encode([
                "status" => "success",
                "mensaje" => "Producto editado correctamente"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error al editar el producto"
            ]);
        }

        exit;

        //Este fragmento sirve si pero no valida que se ingresen los dato bien en el front por eso solo manda true o false (0, 1); 
        /*$datos = $db->editarProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $activo); 
        echo $datos ? 1: 0; */

        break;
    default:
        echo json_encode(["data" => []]);
}
