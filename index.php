<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
$var_admin = $_SESSION['gerente'];


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.1-dist/css/bootstrap.min.css">
    <script src="librerias/bootstrap-5.1.1-dist/js/bootstrap.min.js"></script>

    <title>Hotel Sureste</title>
</head>

<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <form class="container-fluid justify-content-start">
                <a class="navbar-brand" href="https://143.244.172.240/hotel_sureste/">
                    <img src="imagenes/logo.PNG" alt="" width="200" height="100">
                </a>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='views/reservaciones.php'">Reservaciones</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='views/datos_cliente.php'">Datos del cliente</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='views/contacto.php'">Contacto</button>
                <?php 

                if($var_admin !== null || $var_admin != ''){
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='views/administracion.php'\">Mensajes</button>";
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='views/compras_clientes.php'\">compras de clientes</button>";
                    
                }
                
                if($varsesion !== null || $varsesion != ''){
                echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='models/cerrar_sesion.php'\">Cerrar sesión</button>";
                }
                
                ?>

            </form>
        </div>

    </nav>
    <div class="div_img">
        <div class="img_banner1">
        </div>
        <div class="img_banner2">
        </div>
        <input type="button" value="Login" class="btn btn-primary btn-lg login" id="btn_login" onclick="show_login()">
        <input type="button" value="Registrarse" class="btn btn-primary btn-lg registrarse" id="btn_registrarse" onclick="show_registrar()">

    </div>
    

    <!-- Contenido de la página -->
    <div class="container">
     
    </div>

    <!-- Aqui comienza el Footer -->
    <?php
        include("../footer.php");
    ?>



</body>
<link rel="stylesheet" href="librerias/estilos/estilos.css">
<script src="controllers/control.js"></script>

</html>