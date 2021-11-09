<?php

$tipo = $_POST['tipo'];
$cliente = $_POST['cliente'];

$enlace = mysqli_connect("localhost", "admin", "coronavirus9", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{
    
    $actualizar = "UPDATE habitaciones SET disponible=1 WHERE tipo = '$tipo'";

    $datos = mysqli_query($enlace, $actualizar);

    if($datos){

        $consultar_id = "SELECT id_habitacion FROM habitaciones WHERE tipo = '$tipo'";
        $datos_2 = mysqli_query($enlace, $consultar_id);
        $id_habitacion = 0;
        foreach($datos_2 as $key){
            $id_habitacion = $key['id_habitacion'];
        }

       $elim_reserv = "DELETE FROM reservaciones WHERE id_habitacion = $id_habitacion";
       $datos_elim = mysqli_query($enlace, $elim_reserv);
        
       
       if($datos_elim){

           echo "Todo eliminado";
       }
        
    }



}


