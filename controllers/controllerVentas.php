<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/modeloVentas.php';

$db = new modeloVentas();

$opcion = $_POST['opcion'] ?? '';

switch ($opcion) {
    case 'guardar-venta':
        //capturamos los datos que viene en el js 
        $total = $_POST['total'] ?? 0;
        $pago = $_POST['pago'] ?? 0;
        $cambio = $_POST['cambio'] ?? 0;
        $metodo_pago = $_POST['metodo_pago'] ?? '';
        $items = json_decode($_POST['items'] ?? '[]', true);
        //Validaciones necesarias (Que no llegue vacio el carrito y que total no sea menoa a 0)

        if ($total <= 0 || empty($items)) {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Datos de venta invalidos"
            ]);
            exit;
        }

        //llamamos al modelo 
        $resultado = $db->registrarVenta($total, $pago, $cambio, $metodo_pago, $items);

        //Responemos al frontend 
        if ($resultado === true)  {
            echo json_encode([
                "status" => "success",
                "mensaje" => "Venta registrada correctamente"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensaje" =>  $resultado
            ]);
        }

        exit;

        break;
    default:
        echo json_encode([
            "status" => "error",
            "mensaje" => "Opción no válida"
        ]);
        exit;
}
