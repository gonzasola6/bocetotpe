<?php
require_once "conexion.php";


$query = $db->prepare('INSERT INTO pagos(deudor,cuota,cuota_capital,fecha_pago) VALUES (?, ?, ?, ?)');
$query->execute(["cris", "12", "4425.5","2024-04-07"]);

$query = $db->prepare('INSERT INTO pagos(deudor,cuota,cuota_capital,fecha_pago) VALUES (?, ?, ?, ?)');
$query->execute(["nico", "4", "1025.5","2024-06-01"]);

$query = $db->prepare('INSERT INTO pagos(deudor,cuota,cuota_capital,fecha_pago) VALUES (?, ?, ?, ?)');
$query->execute(["jose", "1", "925.5","2024-09-09"]);




