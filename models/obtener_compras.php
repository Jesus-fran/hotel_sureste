<?php


session_start();
error_reporting(0);



$var_admin = $_SESSION['gerente'];

if($var_admin == null || $var_admin == ''){
    header("Location:../views/login.php");
}else{

    
    $mensaje = "";
    $enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

    if(!$enlace){
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;

    }else{


        $consulta = "SELECT usuario, tel, fecha_estancia, tipo, personas FROM habitaciones INNER JOIN reservaciones ON habitaciones.id_habitacion = reservaciones.id_habitacion INNER JOIN usuarios ON reservaciones.id_usuario = usuarios.id_usuario;";
        $datos_consult = mysqli_query($enlace, $consulta);
        if($datos_consult){
            $rows_datos = mysqli_num_rows($datos_consult);
            if($rows_datos != 0){

                $compras = "";
                $contador = 0;

                foreach($datos_consult as $key){
                    $contador += 1;
                    $compras .= "<tr>
                    <th scope=\"row\">".$contador."</th>
                    <td>".$key['usuario']."</td>
                    <td>".$key['tel']."</td>
                    <td>".$key['Fecha_estancia']."</td>
                    <td>".$key['tipo']."</td>
                    <td>".$key['personas']."</td>
                    </tr>";
                    
                }
            }
        }

    

    }

}


