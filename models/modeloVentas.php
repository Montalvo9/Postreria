<?php

include_once('../config/connection_postreria.php');

class modeloVentas
{
    private $modelo;
    private $db;

    public function __construct()
    {
        $this->modelo = array();
        $this->db = PostreriaConnection::ConnectionPostreria();
    }


    public function registrarVenta($total, $pago, $cambio, $metodo_pago, $items)
    {
        try {

            /**Validamos que exista productos en el stock, si no hay stock entonces venderan productos que ya no se tiene */

            foreach ($items as $item) {
                $sqlCheck = "SELECT stock, nombre FROM productos WHERE id_producto = :id";
                $stmCheck = $this->db->prepare($sqlCheck);
                $stmCheck->execute([':id' => $item['id']]);
                $producto = $stmCheck->fetch(PDO::FETCH_ASSOC);

                if (!$producto || $producto['stock'] < $item['qty']) {
                    //Si no hay suficiente stock lanzamos una excepción para ir al catch
                    throw new Exception("Stock insuficiente para: " . ($producto['nombre'] ?? 'Producto desconocido'));
                }
            }
            // Iniciamos una TRANSACCIÓN
            // Esto sirve para que si algo falla, se deshaga TODO
            // (venta, detalle y actualización de stock)
            $this->db->beginTransaction();


            // ==============================
            // 1️ INSERTAR LA VENTA PRINCIPAL
            // ==============================

            // Preparamos la consulta para insertar la venta
            $sqlVenta = "INSERT INTO ventas (id_usuario, total, pago, cambio, metodo_pago)
                     VALUES (:id_usuario, :total, :pago, :cambio, :metodo_pago)";

            $stmtVenta = $this->db->prepare($sqlVenta);


            $id_usuario = $_SESSION['id_usuario'] ?? null;
            if (!$id_usuario) {
                die(json_encode(["status" => "error", "mensaje" => "Sesión no válida"]));
            }

            // Enlazamos los parámetros con los valores que llegan
            $stmtVenta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmtVenta->bindParam(':total', $total);
            $stmtVenta->bindParam(':pago', $pago);
            $stmtVenta->bindParam(':cambio', $cambio);
            $stmtVenta->bindParam(':metodo_pago', $metodo_pago);

            // Ejecutamos la consulta
            $stmtVenta->execute();

            // Obtenemos el ID de la venta recién insertada
            // Esto es muy importante para poder registrar el detalle
            $id_venta = $this->db->lastInsertId();



            // ====================================
            // 2️ PREPARAMOS LA INSERCIÓN DEL DETALLE
            // ====================================

            // Consulta para guardar cada producto vendido
            $sqlDetalle = "INSERT INTO detalle_ventas
                       (id_venta, id_producto, cantidad, precio, subtotal)
                       VALUES (:id_venta, :id_producto, :cantidad, :precio, :subtotal)";

            $stmtDetalle = $this->db->prepare($sqlDetalle);



            // ====================================
            // 3️ PREPARAMOS LA ACTUALIZACIÓN DE STOCK
            // ====================================

            // Cada vez que se vende un producto se descuenta del stock
            $sqlStock = "UPDATE productos 
                     SET stock = stock - :cantidad 
                     WHERE id_producto = :id_producto";

            $stmtStock = $this->db->prepare($sqlStock);



            // ====================================
            // 4️ RECORREMOS LOS PRODUCTOS DEL CARRITO
            // ====================================

            // $items es el carrito que viene desde JS
            // Ejemplo:
            // [
            //   {id:33, nombre:"Hamburguesa", precio:60, qty:1}
            // ]

            foreach ($items as $item) {

                // Guardamos los datos del producto en variables
                $id_producto = $item['id'];     // id del producto
                $cantidad = $item['qty'];       // cantidad vendida
                $precio = $item['precio'];      // precio unitario

                // Calculamos el subtotal
                $subtotal = $cantidad * $precio;



                // ===============================
                // INSERTAMOS EL DETALLE DE VENTA
                // ===============================

                $stmtDetalle->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
                $stmtDetalle->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmtDetalle->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $stmtDetalle->bindParam(':precio', $precio);
                $stmtDetalle->bindParam(':subtotal', $subtotal);

                // Ejecutamos el insert
                $stmtDetalle->execute();



                // ===============================
                // ACTUALIZAMOS EL STOCK
                // ===============================

                $stmtStock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $stmtStock->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

                // Ejecutamos la actualización
                $stmtStock->execute();
            }



            // ===============================
            // 5️ CONFIRMAMOS LA TRANSACCIÓN
            // ===============================

            // Si todo salió bien se guardan todos los cambios
            $this->db->commit();

            //return true;   *Antes retornaba true para confirmar que se hizo la venta 

            return $id_venta;
        } catch (Exception $e) { // Cambia PDOException por Exception para atrapar el stock
            // 1. Un solo rollback bien validado
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }


            // Devolvemos el mensaje para que el controlador lo reciba.
            return $e->getMessage();
        }
    }



    public function obtenerDetalleTicket($id_venta)
    {
        // Traemos la cabecera de la venta
        $sqlVenta = "SELECT v.*, u.usuario FROM ventas v 
                 JOIN usuarios u ON v.id_usuario = u.id_usuario 
                 WHERE v.id_venta = :id";
        $stmt = $this->db->prepare($sqlVenta);
        $stmt->execute([':id' => $id_venta]);
        $venta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$venta) return null;

        // Traemos los productos
        $sqlItems = "SELECT dv.*, p.nombre FROM detalle_ventas dv
                 JOIN productos p ON dv.id_producto = p.id_producto
                 WHERE dv.id_venta = :id";
        $stmtItems = $this->db->prepare($sqlItems);
        $stmtItems->execute([':id' => $id_venta]);
        $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

        return ['venta' => $venta, 'items' => $items];
    }

    /**Funcion para obtener la conualta de reportes de total de venta por dia (hoy)
     * semana, mes y una fecha en concreto dd/mm/aaaa
     */

    public function obtenerVentasTotales($periodo, $fecha = null)
    {
        $query = "";

        if ($periodo == "hoy") {
            $query = "SELECT SUM(total) AS total 
                    FROM ventas WHERE DATE(fecha) = CURDATE()
                    AND estado = 'completada'";

        } elseif ($periodo == "semana") {
            $query = "SELECT SUM(total) as total
                    FROM ventas WHERE YEARWEEK(fecha,1) = YEARWEEK(CURDATE(),1)
                    AND estado = 'completada'";

        } elseif ($periodo == "mes") {
            $query = "SELECT SUM(total) AS total
                FROM ventas
                WHERE MONTH(fecha) = MONTH(CURDATE())
                AND YEAR(fecha) = YEAR(CURDATE())
                AND estado = 'completada'";
        }elseif($periodo == "custom"){
            $query = "SELECT SUM(total) as total
                      FROM ventas
                      WHERE DATE(fecha) = ? 
                      AND estado = 'completada'"; 
        }
        $consulta = $this->db->prepare($query); 

        if($periodo == "custom"){
            $consulta->execute([$fecha]); 
        }else{
            $consulta->execute(); 
        }

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
}
