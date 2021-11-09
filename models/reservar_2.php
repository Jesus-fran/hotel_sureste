<?php


session_start();
error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];



if($var_cliente == null || $var_cliente == ''){
    header("Location:../views/login.php");
}



// Dato habitacional
$fecha      = $_POST['fecha'];
$habitacion = $_POST['habitacion'];
$numero     = $_POST['num_habitacion'];
$personas   = $_POST['personas'];


// Dato personal
$cliente    = $var_cliente;

// Datos bancarios
$tarjeta     = $_POST['tarjeta'];
$fecha_vence = $_POST['fecha_vence'];
$codigo      = $_POST['codigo'];
$postal      = $_POST['postal'];

echo $fecha;
echo $habitacion;
echo $numero;
echo $personas;
echo $cliente;
echo $tarjeta;
echo $fecha_vence;
echo $codigo;
echo $postal;