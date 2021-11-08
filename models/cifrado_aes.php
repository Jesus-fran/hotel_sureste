<?php
// $id_usuario = 13;
// $str = "Hola mundo";

// Se lee la llave privada que se encuentra en el servidor
$llave = file_get_contents('llaves/'.$id_usuario.'.txt');

if($llave){


    // Encripta la información
    function encriptar($str, $llave){
        $data = openssl_encrypt($str, 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
        $data = base64_encode($data);
        return $data;
    }
    
    
    

    //Desencripta la información
    function decrypted($data, $llave){
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
        return $decrypted;
    }
   
    
   

}else{

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

    

    //Desencripta la información
    function decrypted($data, $llave){
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
        return $decrypted;
    }
    

}


// $data = encriptar($str, $llave);

// $desencriptado = decrypted($data, $llave);
