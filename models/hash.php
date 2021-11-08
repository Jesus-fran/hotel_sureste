<?php


// Encripta y retorna en whirlpool los datos
function encrip_datos($datos){

    $email = hash('whirlpool', $datos);
    return $email;
}

// Encripta y retorna la contraseña
function encrip_pass($contraseña){
    $pass_encript = password_hash($contraseña, PASSWORD_DEFAULT, ['cost' => 10]);
    return $pass_encript;
}

