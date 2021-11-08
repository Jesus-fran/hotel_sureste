<?php

session_start();


$var_admin = $_SESSION['gerente'];

if($var_admin == null || $var_admin == ''){
    header("Location:login.php");
}



$enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;

}else{


    $consulta = "SELECT * FROM mensajes";
    $datos_consult = mysqli_query($enlace, $consulta);
    if($datos_consult){
        if($datos_consult != 0){
            $contador = 0;
            foreach($datos_consult as $mensaje){
                $contador += 1;
                $id_mensaje = $mensaje['id_mensaje'];
                $usuario = $mensaje['cliente'];
                $tel    = $mensaje['tel'];
                $email  = $mensaje['email'];

                echo "<tr>
                <td>".$contador."</td>
                <td>".$usuario."</td>
                <td>".$tel."</td>
                <td>".$email."</td>
                <td><button class=\"btn btn-success\" data-id_mens=".$id_mensaje." onclick=\"show_mensaje(this)\">Ver</button></td>
                </tr>
                ";
            }
        }
    }

  

}


