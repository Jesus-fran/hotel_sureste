<?php

$tipo = $_POST['tipo'];
$cliente = $_POST['cliente'];

$enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

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

       $elim_tarjet = "DELETE FROM tarjetas WHERE id_cliente = (SELECT id_cliente FROM clientes WHERE id_habitacion = $id_habitacion)";
       $datos_elim = mysqli_query($enlace, $elim_tarjet);
        
       
       if($datos_elim){

            $elim_rsa = "DELETE FROM claves_rsa WHERE id_cliente = (SELECT id_cliente FROM clientes WHERE cliente = '$cliente' AND id_habitacion = $id_habitacion)";
            $datos_rsa_elim = mysqli_query($enlace, $elim_rsa);
            if($datos_rsa_elim){
                $elim_cliente = "DELETE FROM clientes WHERE id_habitacion = $id_habitacion";
                $datos_elim_cliente = mysqli_query($enlace, $elim_cliente);
    
                if($datos_elim_cliente){
                    echo "Todo eliminado";
                }
            }

           
       }
        
    }



}


