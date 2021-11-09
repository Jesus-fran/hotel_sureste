<?php

$enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{

    $consultar_tarjet = "SELECT * FROM tarjetas WHERE id_usuario = $id_usuario";
    $datos_consult = mysqli_query($enlace, $consultar_tarjet);
    $datos = array();

    foreach($datos_consult as $key){
        $tarjeta = $key['num_tarjeta'];
        $fecha = $key['fecha'];
        $codigo = $key['codigo'];
        $postal = $key['postal'];
        $datos = array("num_tarjeta"=>$tarjeta,"fecha"=>$fecha,"codigo"=>$codigo, "postal"=>$postal);
    }

    

}
    