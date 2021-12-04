<?php

session_start();
error_reporting(0);


$var_admin = $_SESSION['gerente'];

if($var_admin == null || $var_admin == ''){
    header("Location:login.php");
}

$id_mensaje = 0;

if(isset($_GET["id"])){
    $id_mensaje = $_GET["id"];

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
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='administracion.php'\">Mensajes</button>";
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='compras_clientes.php'\">compras de clientes</button>";
                    
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='../models/cerrar_sesion.php'\">Cerrar sesión</button>";
                
                }
                
                ?>


            </form>
        </div>

    </nav>




    <div class="container">
        <h4 class="text-center">Mensajes del cliente</h4>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <textarea id="llave_privada" placeholder="Ingresa la llave privada" rows="15"></textarea>
                </div>
            </div>
            <div class="col-md-6 offset-md-1">
               
                <div class="card">
                    
                        <h5 class="card-header">Encriptado</h5>
                        <div class="card-body">
                            <div class="container">

                            <?php 
                            
                            include("../models/obtener_mensaje.php");

                            echo "<div id=\"mensaje_encriptado\">".$mensaje."</div>";
                            
                            
                            ?>
                            </div>
                                
                            
                        </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
               
                <div class="card">
                    
                        <h5 class="card-header">Desencriptado</h5>
                        <div class="card-body">
                            <div class="container">

                            <div id="div_mensaje"></div>
                                
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 offset-md-4">
                                        <?php
                                        echo "<input type=\"button\" value=\"Desencriptar\" class=\"btn btn-primary\" onclick=\"descifrar_mens()\">";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
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