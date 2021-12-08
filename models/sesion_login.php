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


   
    $consultar = "SELECT id_usuario, usuario, dir, tel, email, pass FROM usuarios";

    $datos_consult = mysqli_query($enlace, $consultar);
    $num_rows = mysqli_num_rows($datos_consult);
    
    // Se crea la sesión de un usuario
    if($num_rows != 0){
        
            
        foreach($datos_consult as $key){
            

            // Se lee la llave privada que se encuentra en el servidor
            $llave = file_get_contents('llaves/'.$key['id_usuario'].'.txt');


            if($llave){

                //Desencripta la información
                function decrypted($data, $llave){
                    $decrypted = openssl_decrypt(base64_decode($data), 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
                    return $decrypted;
                }

                $email_decript = decrypted($key['email'], $llave);
                $pass_decript = decrypted($key['pass'], $llave);

                if($email_decript == $email && $pass_decript == $pass){
                    
                    $_SESSION['id_usuario'] = $key['id_usuario'];
                    $_SESSION['usuario'] = $key['usuario'];
                    $_SESSION['dir'] = $key['dir'];
                    $_SESSION['tel'] = $key['tel'];

                    header("Location:../views/datos_cliente.php");
                }else{
                    header("Location: ../views/login.php?fallo=true");
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

            }else{
                header("Location: ../views/login.php?fallo=true");
            }
        }else{
            header("Location: ../views/login.php?fallo=true");
        }
    }




}
