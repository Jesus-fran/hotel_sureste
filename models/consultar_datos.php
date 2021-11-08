<?php

// error_reporting(0);

$var_cliente = $_SESSION['usuario'];

if($var_cliente != null || $var_cliente != ''){


    $enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

    if(!$enlace){
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }else{
    

        $consulta = "SELECT fecha_estancia, tipo, personas  FROM reservaciones INNER JOIN habitaciones ON reservaciones.id_habitacion = habitaciones.id_habitacion WHERE cliente = '$var_cliente'";

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

        $consulta_2 = "SELECT email, tel, num_tarjeta  FROM reservaciones INNER JOIN tarjetas ON reservaciones.id_cliente = tarjetas.id_cliente WHERE cliente = '$var_cliente' LIMIT 1;";
        $consulta_ejec_2= mysqli_query($enlace, $consulta_2);
        $num_rows_2 = mysqli_num_rows($consulta_ejec_2);

        
        $dato_person = "";

        

        foreach($consulta_ejec_2 as $key){
            $dato_person = "
            
            <table class=\"table\">
            <tbody>
                <tr>
                    <td>Nombre del cliente</td>
                    <td>".$var_cliente."</td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td>".$key['email']."</td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td>".$key['tel']."</td>
                </tr>
                <tr>
                    <td>Tarjeta bancaria</td>
                    <td>".$key['num_tarjeta']."</td>
                </tr>
            </tbody>
            </table>";
            
        }

        if($num_rows_2==0){
            $dato_person = "<h6 class=\"text-center\">Ningúna información</h6>";
        }
        
    }



}



