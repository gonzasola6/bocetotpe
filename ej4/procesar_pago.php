<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $deudor = $_POST['deudor'];
    $cuota = $_POST['cuota'];
    $cuota_capital = $_POST['cuota_capital'];
    $fecha_pago = $_POST['fecha_pago'];

    try {
        // Preparar la consulta de inserción
        $query = $db->prepare('INSERT INTO pagos (deudor, cuota, cuota_capital, fecha_pago) VALUES (?, ?, ?, ?)');

        // Ejecutar la inserción
        $query->execute([$deudor, $cuota, $cuota_capital, $fecha_pago]);

        echo "Pago ingresado correctamente.";

    } catch (PDOException $e) {
        echo "Error al ingresar el pago: " . $e->getMessage();
    } 
} else {
        echo "Método de solicitud no permitido.";
    }
