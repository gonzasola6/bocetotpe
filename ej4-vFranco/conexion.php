<?php

function getPagos(){

    //abro la conexion
    $db = new PDO('mysql:host=localhost;dbname=ej3tp3;charset-utf8','root','');


    //ejecuto consulta

    $query = $db->prepare('SELECT * FROM pagos');
    $query->execute();

    //obtengo datos

    $pagos = $query->fetchAll(PDO::FETCH_OBJ); //devuelve arreglo con todos los datos

    return $pagos;
}

$pagos = getPagos();

echo "<ul>";
foreach($pagos as $pago){
    echo "<li> $pago->deudor (cuota nro: $pago->cuota)</li>";
}
echo"</ul>";