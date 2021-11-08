<?php


$mensaje_encriptado = $_POST['mensaje'];
$llave_privada = $_POST['llave_privada'];


$mensaje_encriptado = base64_decode($mensaje_encriptado);


// Descifra el mensaje

    if($mensaje_encriptado != null || $mensaje_encriptado != ''){
        if($llave_privada != null || $llave_privada != ''){
            
            openssl_private_decrypt($mensaje_encriptado, $mensaje_descifrado, $llave_privada);

            if($mensaje_descifrado){
                echo $mensaje_descifrado;
            }else{
                echo "Hubo un Error";
            }
        }else{
            echo "hubo un Error";
        }
    }else{
        echo "hubo un Error";
    }
   



