<?php

session_start();
error_reporting(0);



$var_admin = $_SESSION['gerente'];

if($var_admin == null || $var_admin == ''){
    header("Location:login.php");
}

    $mensaje = "";
    $enlace = mysqli_connect("localhost", "admin", "coronavirus9", "hotel_sureste");

    if(!$enlace){
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;

    }else{


        $consulta = "SELECT * FROM mensajes WHERE id_mensaje = $id_mensaje";
        $datos_consult = mysqli_query($enlace, $consulta);
        if($datos_consult){
            $rows_datos = mysqli_num_rows($datos_consult);
            if($rows_datos != 0){
            
                foreach($datos_consult as $mensaje){
                    $mensaje = $mensaje['mensaje'];

                }
            }
        }

    

    }

