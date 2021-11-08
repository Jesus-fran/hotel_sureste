<?php

$habitacion = $_POST['habitacion'];

$enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{

    if($habitacion == 'Suite'){
        $consulta = "SELECT * FROM habitaciones WHERE tipo LIKE '%suite%' AND disponible = 1";
        $datos = mysqli_query($enlace, $consulta);
    
        foreach($datos as $key){
            $tipo = $key['tipo'];
            
            echo "<option value=\"$tipo\">$tipo</option>";
        }
    }
    if($habitacion == 'Cuarto doble'){
        $consulta = "SELECT * FROM habitaciones WHERE tipo LIKE '%doble%' AND disponible = 1";
        $datos = mysqli_query($enlace, $consulta);
    
        foreach($datos as $key){
            echo $tipo = $key['tipo'];
            echo "<option value=\"$tipo\">$tipo</option>";
        }
    }

    if($habitacion == 'Cuarto sencillo'){
        $consulta = "SELECT * FROM habitaciones WHERE tipo LIKE '%sencillo%' AND disponible = 1";
        $datos = mysqli_query($enlace, $consulta);
    
        foreach($datos as $key){
            echo $tipo = $key['tipo'];
            echo "<option value=\"$tipo\">$tipo</option>";
        }
    }
   
}
