<?php

require_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Deudor</th>
            <th>Cuota</th>
            <th>Cuota capital</th>
            <th>Fecha pago</th>
        </tr>
        
        <?php
        foreach($pagos as $pago){?>
        <tr>
            <td><?= htmlspecialchars($pago->id) ?></td>
                <td><?= htmlspecialchars($pago->deudor) ?></td>
                <td><?= htmlspecialchars($pago->cuota) ?></td>
                <td><?= htmlspecialchars($pago->cuota_capital) ?></td>
                <td><?= htmlspecialchars($pago->fecha_pago) ?></td>
        </tr>
        <?php 
        }?>
        
    </table>

    <form action=""></form>
</body>
</html>