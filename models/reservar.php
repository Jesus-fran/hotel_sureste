<?php


session_start();
// error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];



if($var_cliente == null || $var_cliente == ''){
    header("Location:login.php");
}



// Dato habitacional
$fecha      = $_POST['fecha'];
$habitacion = $_POST['habitacion'];
$numero     = $_POST['num_habitacion'];
$personas   = $_POST['personas'];

// Dato personal
$cliente    = $var_cliente;

// Datos bancarios
$tarjeta     = $_POST['tarjeta'];
$fecha_vence = $_POST['fecha_vence'];
$codigo      = $_POST['codigo'];
$postal      = $_POST['postal'];


include("cifrado_aes.php");

$tarjeta_encript = encriptar($tarjeta, $llave);
$codigo_encript = encriptar($codigo, $llave);



$enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{
    
  
    // Encontrar id de habitación
    $actualizar = "UPDATE habitaciones SET disponible=0 WHERE tipo = '$numero'";
    $datos = mysqli_query($enlace, $actualizar);
    
    if($datos){

       

        $consultar_habit = "SELECT id_habitacion FROM habitaciones WHERE tipo = '$numero'";
        $datos_consult = mysqli_query($enlace, $consultar_habit);
        
        foreach($datos_consult as $key){
            $numero = $key['id_habitacion'];
        }
        if($numero != null){



            $insert = "INSERT INTO reservaciones (id_usuario, fecha_estancia, id_habitacion, personas) VALUES ($id_usuario,'$fecha', $numero , $personas)";
            

            $datos_insert = mysqli_query($enlace, $insert);

            if($datos_insert){

                $consultar_tarjet = "SELECT * FROM tarjetas WHERE id_usuario = $id_usuario";
                $ejecutar_tarjet = mysqli_query($enlace, $consultar_tarjet);

                if($ejecutar_tarjet){

                    $rows_dato = mysqli_num_rows($ejecutar_tarjet);
                    if($rows_dato == 0){
                    
                        $insert_tarjet = "INSERT INTO tarjetas (id_usuario,  num_tarjeta, fecha, codigo, postal) VALUE ($id_usuario, '$tarjeta_encript' ,'$fecha_vence', '$codigo_encript', $postal)";

                        $datos_tarjet = mysqli_query($enlace, $insert_tarjet);
                        
                        if($datos_tarjet){
                        
                            header("Location: ../views/datos_cliente.php");
                            

                        }    
                    }else{
                        header("Location: ../views/datos_cliente.php");
                    }
                }

               

            }
        }
        
        
    }
    
    
}