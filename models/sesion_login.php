<?php
session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];


$enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{

    include("hash.php");
    $email_encript = encrip_datos($email);

    $consultar = "SELECT pass FROM usuarios WHERE email = '$email_encript'";

    $datos_consult = mysqli_query($enlace, $consultar);
    $num_rows = mysqli_num_rows($datos_consult);
    
    // Se crea la sesión de un usuario
    if($num_rows != 0){
        
            // 
        foreach($datos_consult as $key){
            

            if(password_verify($pass, $key['pass'])){

                $pass_verificado = password_verify($pass, $key['pass']);

                $consultar_datos = "SELECT * FROM usuarios WHERE email = '$email_encript'";
                $datos_consult_dts = mysqli_query($enlace, $consultar_datos);
                $num_rows_dts = mysqli_num_rows($datos_consult_dts);
                if($num_rows_dts != 0){

                    foreach($datos_consult_dts as $key_datos){
                        $_SESSION['id_usuario'] = $key_datos['id_usuario'];
                        $_SESSION['usuario'] = $key_datos['usuario'];
                        $_SESSION['dir'] = $key_datos['dir'];
                        $_SESSION['tel'] = $key_datos['tel'];
                    }
                    header("Location:../views/datos_cliente.php");
                }else{
                    
                    header("Location:../views/login.php");
                    
                }
                
            }else{
                header("Location: ../views/login.php?fallo=true");
            }
            
        }
         

    }

    // Se crea la sesión de un administrador
    if($num_rows == 0){
        $consultar_admin = "SELECT * FROM administradores WHERE email = '$email' AND pass = '$pass'";
        $datos_consult_admin = mysqli_query($enlace, $consultar_admin);
        if($datos_consult_admin){
            $num_rows_admin = mysqli_num_rows($datos_consult_admin);
            if($num_rows_admin != 0){

                foreach($datos_consult_admin as $key){
                    $_SESSION['id_usuario'] = $cliente = $key['id_administrador'];
                    $_SESSION['usuario'] = $cliente = $key['nombre'];
                    $_SESSION['gerente'] = $cliente = $key['nombre'];
                    $_SESSION['email'] = $dir = $key['email'];
                    $_SESSION['pass'] = $pass = $key['pass'];
                    $_SESSION['tel'] = $tel = $key['tel'];
                    $_SESSION['cargo'] = $pass = $key['cargo'];

                }

                header("Location:../views/administracion.php"); 

            }
        }
    }




}
