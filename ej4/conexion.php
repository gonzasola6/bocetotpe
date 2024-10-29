<?php

$db = new PDO('mysql:host=localhost;dbname=ej3tp3;charset-utf8','root','');

$sentencia = $db->prepare("SELECT * FROM pagos");
$sentencia->execute();

$pagos = $sentencia->fetchAll(PDO::FETCH_OBJ);
