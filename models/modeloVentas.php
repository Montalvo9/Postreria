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
                $sqlCheck = "SELECT stock, nombre, activo FROM productos WHERE id_producto = :id";
                $stmCheck = $this->db->prepare($sqlCheck);
                $stmCheck->execute([':id' => $item['id']]);
                $producto = $stmCheck->fetch(PDO::FETCH_ASSOC);

                // Nueva validación: ¿Existe? ¿Está activo? ¿Hay stock?
                if (!$producto) {
                    throw new Exception("El producto ya no existe en la base de datos.");
                }

                if ($producto['activo'] == 0) {
                    throw new Exception("El producto '" . $producto['nombre'] . "' está desactivado y no se puede vender.");
                }

                if ($producto['stock'] < $item['qty']) {
                    throw new Exception("Stock insuficiente para: " . $producto['nombre']);
                }

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


    /**Devuelve el contenido de una sola venta para imprimir el tocket 
     * despues de que la venta ha sido realizada
     */
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
     * ESTA FUNCION SIRVE SOLO PARA OBTENER LAS VENTAS TOTALES POR SEMANA , HOY, MES 
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
        } elseif ($periodo == "custom") {
            $query = "SELECT SUM(total) as total
                      FROM ventas
                      WHERE DATE(fecha) = ? 
                      AND estado = 'completada'";
        }
        $consulta = $this->db->prepare($query);

        if ($periodo == "custom") {
            $consulta->execute([$fecha]);
        } else {
            $consulta->execute();
        }

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    /**Esta función es general, sirve para obtener el total como el de la funcion obtenerVentasTotales, pero tambien para obtener los 
     * reportes de Pedidos, numero de productos que se vendieron, y el producto mas vendido , todo en esta sola función
     */
    public function obtenerReportes($periodo, $fecha = null)
    {
        $filtroVentas = "";
        $params = [];

        if ($periodo == "hoy") {
            $filtroVentas = "DATE(v.fecha) = CURDATE()";
        } elseif ($periodo == "semana") {
            $filtroVentas = "YEARWEEK(v.fecha,1) = YEARWEEK(CURDATE(),1)";
        } elseif ($periodo == "mes") {
            $filtroVentas = "MONTH(v.fecha) = MONTH(CURDATE())
                         AND YEAR(v.fecha) = YEAR(CURDATE())";
        } elseif ($periodo == "custom") {
            $filtroVentas = "DATE(v.fecha) = ?";
            $params[] = $fecha;
        }

        // métricas principales
        $sql = "SELECT
            SUM(v.total) AS venta_total,
            COUNT(v.id_venta) AS numero_ventas,
            AVG(v.total) AS ticket_promedio
            FROM ventas v
            WHERE $filtroVentas
            AND v.estado = 'completada'";

        $query = $this->db->prepare($sql);
        $query->execute($params);
        $datos = $query->fetch(PDO::FETCH_ASSOC);

        // productos vendidos
        $sqlProductos = "SELECT 
                     SUM(dv.cantidad) AS productos_vendidos
                     FROM detalle_ventas dv
                     INNER JOIN ventas v ON dv.id_venta = v.id_venta
                     WHERE $filtroVentas
                     AND v.estado = 'completada'";

        $query = $this->db->prepare($sqlProductos);
        $query->execute($params);
        $productos = $query->fetch(PDO::FETCH_ASSOC);

        // producto más vendido
        $sqlTop = "SELECT p.nombre, SUM(dv.cantidad) AS total
               FROM detalle_ventas dv
               INNER JOIN productos p ON dv.id_producto = p.id_producto
               INNER JOIN ventas v ON dv.id_venta = v.id_venta
               WHERE $filtroVentas
               AND v.estado = 'completada'
               GROUP BY dv.id_producto
               ORDER BY total DESC
               LIMIT 1";

        $query = $this->db->prepare($sqlTop);
        $query->execute($params);
        $mas_vendido = $query->fetch(PDO::FETCH_ASSOC);

        return [
            "ventas_totales" => $datos["venta_total"] ?? 0,
            "numero_ventas" => $datos["numero_ventas"] ?? 0,
            "ticket_promedio" => $datos["ticket_promedio"] ?? 0,
            "productos_vendidos" => $productos["productos_vendidos"] ?? 0,
            "producto_top" => $mas_vendido["nombre"] ?? "N/A"
        ];
    }

    public function obtenerTopVendidos($periodo, $fecha = null, $limite = 5)
    {
        $filtroVentas = "";
        $params = [];


        if ($periodo == "hoy") {
            $filtroVentas = "DATE(v.fecha) = CURDATE()";
        } elseif ($periodo == "semana") {
            $filtroVentas = "YEARWEEK(v.fecha,1) = YEARWEEK(CURDATE(),1)";
        } elseif ($periodo == "mes") {
            $filtroVentas = "MONTH(v.fecha) = MONTH(CURDATE())
                         AND YEAR(v.fecha) = YEAR(CURDATE())";
        } elseif ($periodo == "custom") {
            $filtroVentas = "DATE(v.fecha) = ?";
            $params[] = $fecha;
        }

        //Metricas 
        $sql = "SELECT 
                p.nombre,
                SUM(dv.cantidad) AS total_vendidos
            FROM detalle_ventas dv
            INNER JOIN productos p ON dv.id_producto = p.id_producto
            INNER JOIN ventas v ON dv.id_venta = v.id_venta
            WHERE $filtroVentas
            AND v.estado = 'completada'
            GROUP BY dv.id_producto
            ORDER BY total_vendidos DESC
            LIMIT $limite";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function productosVendidos($periodo, $fecha = null)
    {
        $filtroVentas = "";
        $params = [];


        if ($periodo == "hoy") {
            $filtroVentas = "DATE(v.fecha) = CURDATE()";
        } elseif ($periodo == "semana") {
            $filtroVentas = "YEARWEEK(v.fecha,1) = YEARWEEK(CURDATE(),1)";
        } elseif ($periodo == "mes") {
            $filtroVentas = "MONTH(v.fecha) = MONTH(CURDATE())
                         AND YEAR(v.fecha) = YEAR(CURDATE())";
        } elseif ($periodo == "custom") {
            $filtroVentas = "DATE(v.fecha) = ?";
            $params[] = $fecha;
        }


        //metricas 

        $sql = "SELECT 
                p.nombre,
                SUM(dv.cantidad) as total_vendidos,
                SUM(dv.subtotal) as total_generado
                FROM detalle_ventas dv
                INNER JOIN productos p ON dv.id_producto = p.id_producto
                INNER JOIN ventas v ON dv.id_venta = v.id_venta
                WHERE $filtroVentas
                AND v.estado = 'completada'
                GROUP BY dv.id_producto
                ORDER BY total_vendidos DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**Funcion para consultar el historial de ventas para poder reemprimir el ticket
     * esta funcion es una lista de transacciones (ejem- venta#1)
     */

    public function historialVentas($periodo, $fecha = null)
    {
        $filtroVentas = "";
        $params = [];

        if ($periodo == "hoy") {
            $filtroVentas = "DATE(v.fecha) = CURDATE()";
        } elseif ($periodo == "semana") {
            $filtroVentas = "YEARWEEK(v.fecha,1) = YEARWEEK(CURDATE(),1)";
        } elseif ($periodo == "mes") {
            $filtroVentas = "MONTH(v.fecha) = MONTH(CURDATE())
                         AND YEAR(v.fecha) = YEAR(CURDATE())";
        } elseif ($periodo == "custom") {
            $filtroVentas = "DATE(v.fecha) = ?";
            $params[] = $fecha;
        }

        //METRICAS 

        $sql = "SELECT 
                v.id_venta,
                v.fecha,
                v.total,
                u.nombre as vendedor
                FROM ventas v
                INNER JOIN usuarios u ON v.id_usuario = u.id_usuario
                WHERE $filtroVentas
                AND v.estado = 'completada'
                ORDER BY v.fecha DESC"; //Las mas recientes

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
