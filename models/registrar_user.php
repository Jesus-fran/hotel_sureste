<?php

$usuario    = $_POST['usuario'];
$direccion  = $_POST['direccion'];
$tel        = $_POST['tel'];
$email      = $_POST['email'];
$pass       = $_POST['pass'];

// include("validar_form.php");


// if(validar_user($usuario) && validar_dir($direccion) && validar_tel($tel) && validar_email($email) && validar_pass($pass)){
    


    $enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

    if(!$enlace){
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }else{
        

        $insert = "INSERT INTO usuarios (usuario, dir, tel) VALUES('$usuario', '$direccion', '$tel')";
        
        $ejecutar_insert = mysqli_query($enlace, $insert);
        
        if($ejecutar_insert){
            $id_usuario = "";
            $id_usuario = mysqli_insert_id($enlace);
            
        
            // Se crea la clave
            $aes_key =  bin2hex(random_bytes((100 - (100 % 2)) / 2));


            // Se genera el archivo de la clave
            $archivo = fopen('llaves/'.$id_usuario.'.txt','a+');
            fputs($archivo, $aes_key);
            fclose($archivo);

            // Se lee la llave privada que se encuentra en el servidor
            $llave = file_get_contents('llaves/'.$id_usuario.'.txt');

            // Encripta la información
            function encriptar($str, $llave){

                $data = openssl_encrypt($str, 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
                $data = base64_encode($data);
                return $data;
            }

            $email_encriptado = encriptar($email, $llave);
            $pass_encriptado = encriptar($pass, $llave);

            
            $update_personal = "UPDATE usuarios SET email = '$email_encriptado', pass = '$pass_encriptado' WHERE id_usuario = $id_usuario";
            $ejecutar_update_pers = mysqli_query($enlace, $update_personal);
            
            if($ejecutar_update_pers){
                header ("Location:../views/login.php?registro=true");
            }
        }

    }
 
// }else{
//     header ("Location:../views/registrar.php?fallo=true");
// }



