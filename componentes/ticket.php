<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #<?php echo $venta['id_venta']; ?></title>
    <link rel="stylesheet" href="/Postreria/CSS/ticket.css">
</head>
<body onload="window.print();"> <div class="text-center">
        <h1 class="empresa">El Dulce Rincón</h1>
        <p>Ticket de Venta: #<?php echo $venta['id_venta']; ?></p>
        <p>Fecha: <?php echo date("d/m/Y H:i", strtotime($venta['fecha'])); ?></p>
        <p>Atendido por: <?php echo htmlspecialchars($venta['usuario']); ?></p>
    </div>

    <div class="linea-separadora"></div>

    <table class="tabla-productos">
        <thead>
            <tr>
                <th align="left">Cant.</th>
                <th align="left">Producto</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?php echo $p['cantidad']; ?></td>
                <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                <td align="right">$<?php echo number_format($p['subtotal'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="linea-separadora"></div>

    <div class="totales">
        <p align="right">SUBTOTAL: $<?php echo number_format($venta['total'], 2); ?></p>
        <p align="right">PAGO CON: $<?php echo number_format($venta['pago'], 2); ?></p>
        <p align="right">CAMBIO: $<?php echo number_format($venta['cambio'], 2); ?></p>
        <p align="right" class="total-final"><strong>TOTAL: $<?php echo number_format($venta['total'], 2); ?></strong></p>
    </div>

    <div class="text-center footer">
        <p>¡Gracias por endulzar tu día con nosotros!</p>
        <p>Vuelva pronto</p>
        
        <button class="btn-imprimir" onclick="window.print()">Reimprimir</button>
    </div>

</body>
</html>