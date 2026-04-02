<?php
session_start();
//header('Content-Type: application/json');
require_once __DIR__ . '/../models/modeloVentas.php';

$db = new modeloVentas();

$opcion = $_POST['opcion'] ?? $_GET['opcion'] ?? '';

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
        if (is_numeric($resultado)) {
            echo json_encode([
                "status" => "success",
                "mensaje" => "Venta registrada correctamente",
                "id_venta" => $resultado //Esto lo manda al js (id de venta)
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensaje" =>  $resultado
            ]);
        }

        exit;

        break;
    case 'ver-ticket':
        $id = $_GET['id_venta'] ?? null;
        $resultado = $db->obtenerDetalleTicket($id);

        if ($resultado) {
            // Guardamos los datos en variables para que la vista las use
            $venta = $resultado['venta'];
            $productos = $resultado['items'];
            // Incluimos la vista del ticket
            include __DIR__ . '/../componentes/ticket.php';
        } else {
            echo "Ticket no encontrado";
        }
        break;

    case "obtener-reporte":
        $periodo = $_POST['periodo'] ?? 'hoy';
        $fecha = $_POST['fecha'] ?? null;

        $resultado = $db->obtenerReportes($periodo, $fecha);

        if ($resultado) {
            echo json_encode([
                "status" => "success",
                "resultado" => $resultado
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error al ejecutar la consulta"
            ]);
        }
        exit;
        break;

    case "top-vendidos":
        $periodo = $_POST['periodo'] ?? 'hoy';
        $fecha = $_POST['fecha'] ?? null;
        $limite = $_POST['limite'] ?? 5;

        $resultado = $db->obtenerTopVendidos($periodo, $fecha, $limite);

        echo json_encode([
            "status" => "success",
            "data" => $resultado
        ]);
        exit;
        break;

    default:
        echo json_encode([
            "status" => "error",
            "mensaje" => "Opción no válida"
        ]);
        exit;
}
