<?php

// error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];

if($var_cliente != null || $var_cliente != ''){


    $enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

    if(!$enlace){
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }else{
    

        $consulta = "SELECT fecha_estancia, tipo, personas  FROM reservaciones INNER JOIN habitaciones ON reservaciones.id_habitacion = habitaciones.id_habitacion WHERE id_usuario = $id_usuario";

        $consulta_ejec= mysqli_query($enlace, $consulta);

        $num_rows = mysqli_num_rows($consulta_ejec);
                
        $dato_habit = "";

        foreach($consulta_ejec as $key){
            $dato_habit .= "
            
            <table class=\"table\">
            <tbody>
                <tr>
                    <td>Fecha de estancia</td>
                    <td>".$key['fecha_estancia']."</td>
                </tr>
                <tr>
                    <td>Tipo de habitación</td>
                    <td>".$key['tipo']."</td>
                </tr>
                <tr>
                    <td>Personas que se alojan</td>
                    <td>".$key['personas']."</td>
                </tr>
            </tbody>
            </table>
            <br>
            <div class=\"row\">
                <div class=\"col\">
                    <button type=\"button\" class=\"btn btn-danger\" id=\"fin_reservacion\" data-tipo=\"".$key['tipo']."\""."data-cliente=\"".$var_cliente."\" onclick=\"fin_reservacion()\">Terminar reservación</button>
                </div>
            </div><br>";
            
        }

        if($num_rows==0){
            $dato_habit = "<h6 class=\"text-center\">Ningúna habitación reservada</h6>";
        }

        $consulta_2 = "SELECT usuario, dir, tel, email, pass, num_tarjeta, fecha, codigo, postal FROM usuarios INNER JOIN tarjetas ON usuarios.id_usuario = tarjetas.id_usuario WHERE usuario = '$var_cliente'";
        $consulta_ejec_2= mysqli_query($enlace, $consulta_2);
        $num_rows_2 = mysqli_num_rows($consulta_ejec_2);

        
       

        $usuario = "";
        $dir = "";
        $tel = "";
        $email = "";
        $pass = "";
        $num_tarjeta = "";
        $fecha = "";
        $codigo = "";
        $postal = 0;

        foreach($consulta_ejec_2 as $key){

            
            $usuario = $key['usuario'];
            $dir = $key['dir'];
            $tel = $key['tel'];
            $email = $key['email'];
            $pass = $key['pass'];
            $num_tarjeta = $key['num_tarjeta'];
            $fecha = $key['fecha'];
            $codigo = $key['codigo'];
            $postal = $key['postal'];
            
        }

        // Si se encuentró datos bancarios, hay que descifrar
        if($num_tarjeta != "" || $fecha != "" || $codigo != "" || $postal != 0){
            
        }

        if($num_rows_2==0){
            $dato_person = "<h6 class=\"text-center\">Ningúna información</h6>";
        }
        
    }



}



