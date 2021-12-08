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

            $id_usuario = mysqli_insert_id($enlace);

        
            include("cifrado_aes.php");

            $email_encriptado = encriptar($email, $llave);
            $pass_encriptado = encriptar($pass, $llave);

            echo $email_encriptado ."<br>";
            echo $pass_encriptado."<br>";
            // $update_personal = "UPDATE usuarios SET email = '$email_encriptado', pass = '$pass_encriptado' WHERE id_usuario = $id_usuario";
            // $ejecutar_update_pers = mysqli_query($enlace, $update_personal);
            
            // if($ejecutar_update_pers){
            //     header ("Location:../views/login.php?registro=true");
            // }
        }

    }
 
// }else{
//     header ("Location:../views/registrar.php?fallo=true");
// }



