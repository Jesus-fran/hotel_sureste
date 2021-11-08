<?php

$usuario    = $_POST['usuario'];
$tel        = $_POST['tel'];
$email      = $_POST['email'];
$duda       = $_POST['duda'];


$enlace = mysqli_connect("localhost", "root", "", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{ 
    
    // Aqui todo el proceso de encriptacion
    // Se lee la llave privada que se encuentra en el servidor
    $llave_priv = file_get_contents("llaves/llave_privada.txt");

    // Convirte el string a una llave para ser usada
    $llave_priv = openssl_pkey_get_private($llave_priv);

    // Se crea la llave publica a partir de la llave privada
    $pubKey = openssl_pkey_get_details($llave_priv);

    // Se extrae la llave publica unicamente
    $pubKey = $pubKey["key"];

    // Encripta en mensaje
    openssl_public_encrypt($duda, $duda_encript, $pubKey);
    $duda_encript = base64_encode($duda_encript);


    
    $insert = "INSERT INTO mensajes (cliente, tel, email, mensaje) VALUES ('$usuario', '$tel', '$email','$duda_encript')";

    $datos_insert = mysqli_query($enlace, $insert);
    
  

    if($datos_insert){
        
        header("Location:../views/contacto.php?enviado=true");
        
    }

}

