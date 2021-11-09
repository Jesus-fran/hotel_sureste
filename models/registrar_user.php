<?php

$usuario    = $_POST['usuario'];
$direccion  = $_POST['direccion'];
$tel        = $_POST['tel'];
$email      = $_POST['email'];
$pass       = $_POST['pass'];


include("hash.php");

$email_encriptado = encrip_datos($email);
$pass_encriptado = encrip_pass($pass);


$enlace = mysqli_connect("localhost", "admin", "Coronavirus19$", "hotel_sureste");

if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{
    

    $insert = "INSERT INTO usuarios (usuario, dir, tel, email, pass) VALUES('$usuario', '$direccion', '$tel', '$email_encriptado', '$pass_encriptado')";
    
    $ejecutar_insert = mysqli_query($enlace, $insert);
    if($ejecutar_insert){
        header ("Location:../views/login.php?registro=true");
    }

}

