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
}
