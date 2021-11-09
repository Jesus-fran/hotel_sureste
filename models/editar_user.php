<?php

session_start();

// error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$var_admin = $_SESSION['gerente'];


if($var_cliente == null || $var_cliente == ''){
    header("Location:../views/login.php");
}


$usuario    = $_POST['usuario'];
$direccion  = $_POST['direccion'];
$tel        = $_POST['tel'];
$email      = $_POST['email'];
$pass       = $_POST['pass'];


$num_tarjeta = $_POST['tarjeta'];
$fecha = $_POST['fecha_vence'];
$codigo = $_POST['codigo'];
$postal = $_POST['postal'];



include("hash.php");



$enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{
    
    $consult_info = "SELECT email, pass FROM usuarios WHERE id_usuario = $id_usuario";
    $ejecutar_consult = mysqli_query($enlace, $consult_info);
    
    if($ejecutar_consult){
        $email_bd = "";
        $pass_bd = "";

        foreach($ejecutar_consult as $key){
          
            $email_bd = $key['email'];
            $pass_bd = $key['pass'];    

        }
      

        if($email_bd != $email){
             echo "Se mete al Email";
            if($pass_bd != $pass){
                
                $email_encriptado = encrip_datos($email);
                $pass_encriptado = encrip_pass($pass);

                $actualizar_email_pass = "UPDATE usuarios SET email = '$email_encriptado', pass = '$pass_encriptado' WHERE id_usuario = $id_usuario";
                $datos = mysqli_query($enlace, $actualizar_email_pass);
                if($datos){
                    echo "Editado email y pass <br>";
                }

            }else{

                $email_encriptado = encrip_datos($email);

                $actualizar_email = "UPDATE usuarios SET email = '$email_encriptado' WHERE id_usuario = $id_usuario";
                $datos_act = mysqli_query($enlace, $actualizar_email);
                if($datos_act){
                    echo "Editado solo email";
                }
            }
        
        }

        $consult_banc = "SELECT num_tarjeta, codigo FROM tarjetas WHERE id_usuario = $id_usuario";
        $ejecutar_banc = mysqli_query($enlace, $consult_banc);
        
        if($ejecutar_banc){
            // echo "Se ejecuta el ejecutar_banc";

            $tarjeta_bd = "";
            $codigo_bd = "";

            foreach($ejecutar_banc as $key){
            
                $tarjeta_bd = $key['num_tarjeta'];
                $codigo_bd = $key['codigo'];    

            }

            // echo $tarjeta_bd."<br>";
            // echo $codigo_bd;

            if($tarjeta_bd != $num_tarjeta && $num_tarjeta != ""){
                // echo "Se mete a la tarjeta";
                
                if($codigo_bd != $codigo){
                    
                    include("cifrado_aes.php");

                    $tarjeta_cifrada = encriptar($num_tarjeta, $llave);
                    $codigo_cifrado = encriptar($codigo, $llave);

                    $actualizar_tarj_cod = "UPDATE tarjetas SET num_tarjeta = '$tarjeta_cifrada', codigo = '$codigo_cifrado' WHERE id_usuario = $id_usuario";
                    $datos_tarj_cod = mysqli_query($enlace, $actualizar_tarj_cod);
                    if($datos_tarj_cod){
                        echo "Editado tarjeta y codigo <br>";
                    }
    
                }else{

                    include("cifrado_aes.php");
                    $tarjeta_cifrada = encriptar($num_tarjeta, $llave);

                    $actualizar_tarjeta = "UPDATE tarjetas SET num_tarjeta = '$tarjeta_cifrada' WHERE id_usuario = $id_usuario";
                    $datos_tarjeta = mysqli_query($enlace, $actualizar_tarjeta);
                    if($datos_tarjeta){
                        echo "Editado solo tarjeta";
                    }
                }
            }

            $actualizar_info = "UPDATE usuarios SET usuario = '$usuario', dir = '$direccion', tel = '$tel' WHERE id_usuario = $id_usuario";
            $datos_info = mysqli_query($enlace, $actualizar_info);
            if($datos_info){
                $actualizar_info_banc = "UPDATE tarjetas SET fecha = '$fecha', postal = $postal WHERE id_usuario = $id_usuario";
                $datos_info_banc = mysqli_query($enlace, $actualizar_info_banc);
                if($datos_info_banc){
                    echo  "Todo actualizadoo";
                    header ("Location:cerrar_sesion.php");
                }
            }

        }


    }



   
    // if($ejecutar_insert){
    //     header ("Location:../views/datos_cliente.php");
    // }

}



