<?php

// Las siguientes funcinan validan campos
// y previenen ataques xss scripting

function validar_user($user){
    return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$', $user);
}

function validar_dir($dir){
    return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]');
}

function validar_tel($tel){
    return preg_match('#^\(?\d{2}\)?[\s\.-]?\d{4}[\s\.-]?\d{4}$#', $tel);
}

function validar_email($email){
    return preg_match('/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$', $email);
}

function validar_pass($pass){
    return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]', $pass);
}

function validar_personas($personas){
    return preg_match('[0-9]');
}

function validar_tarjeta($tarjeta){
    return preg_match('^(?:4\d([\- ])?\d{6}\1\d{5}|(?:4\d{3}|5[1-5]\d{2}|6011)([\- ])?\d{4}\2\d{4}\2\d{4})$', $tarjeta);
}

function validar_fecha($fecha){

    return preg_match('[0-9]/', $fecha);
}

function validar_codigo($codigo){
        return preg_match('[0-9]', $codigo);
}

function validar_postal($postal){
    return preg_match('[0-9]', $postal);
}