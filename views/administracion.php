<?php

session_start();
error_reporting(0);


$var_admin = $_SESSION['gerente'];

if($var_admin == null || $var_admin == ''){
    header("Location:login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../librerias/bootstrap-5.1.1-dist/css/bootstrap.min.css">
    <script src="../librerias/bootstrap-5.1.1-dist/js/bootstrap.min.js"></script>
    <script src="../librerias/jquery-3.6.0.min.js"></script>
    <script src="../controllers/control.js"></script>

    <title>Hotel Sureste</title>
</head>

<body class="">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <form class="container-fluid justify-content-start">
                <a class="navbar-brand" href="https://143.244.172.240/hotel_sureste/">
                    <img src="../imagenes/logo.PNG" alt="" width="200" height="100">
                </a>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='reservaciones.php'">Reservaciones</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='datos_cliente.php'">Datos del cliente</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='contacto.php'">Contacto</button>
                <?php 
                
                if($var_admin !== null || $var_admin != ''){
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='administracion.php'\" disabled>Mensajes</button>";
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='compras_clientes.php'\">compras de clientes</button>";
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='../models/cerrar_sesion.php'\">Cerrar sesión</button>";
                }
                
                ?>


            </form>
        </div>

    </nav>




    <div class="container">
    <h4 class="text-center">Mensajes de los clientes</h4>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-secondary" onclick="crear_llave_privada()">Crear llave privada</button>
            <p class="text-danger">Guarde su llave privada para descifrar los mensajes</p>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="col">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opción</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- Aqui se incrustan todos los mensajes -->
                        <?php
                            include '../models/consultar_mensajes.php';
                            echo $mensajes;
                        ?>
                </tbody>
        </table>
            </div>
        </div>
        

    </div>

    <!-- Aqui comienza el Footer -->
    <?php
        include("footer.php");
    ?>

</body>
<link rel="stylesheet" href="../librerias/estilos/estilos.css">

</html>