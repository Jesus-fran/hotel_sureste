<?php
session_start();

error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$var_tel     = $_SESSION['tel'];
$var_admin = $_SESSION['gerente'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../librerias/bootstrap-5.1.1-dist/css/bootstrap.min.css">
    <script src="../librerias/bootstrap-5.1.1-dist/js/bootstrap.min.js"></script>

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
                <button class="btn btn-outline-secondary" type="button" disabled>Contacto</button>
                <?php 
                if($var_admin !== null || $var_admin != ''){
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='administracion.php'\">Mensajes</button>";
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='compras_clientes.php'\">compras de clientes</button>";

                }
                if($var_cliente !== null || $var_cliente != ''){
                echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='../models/cerrar_sesion.php'\">Cerrar sesión</button>";
                }
                
                ?>


            </form>
        </div>

    </nav>




    <div class="container">
        <form method="POST" action="https://143.244.172.240/hotel_sureste/models/enviar_duda.php">
            <div class="row">
                <h4 class="text-center">Realiza una pregunta</h4>
                <?php
                if(isset($_GET["enviado"]) && $_GET["enviado"] == 'true'){
                echo "<h4 class=\"text-success text-center\">¡Enviado correctamente!</h4>";
                }
                ?>
                <h6 class="text-start">Ingresa tus datos primero</h6>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombre del cliente</label>
                        <?php
                         if($var_cliente != null | $var_cliente != ''){
                            echo "<input type=\"text\" name=\"usuario\" class=\"form-control\" placeholder=\"Nombre completo\" value=\"$var_cliente\" required>";
                         }else{
                            echo "<input type=\"text\" name=\"usuario\" class=\"form-control\" placeholder=\"Nombre completo\" required>";
                         }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telefono</label>
                        <?php
                        if($var_tel != null | $var_tel != ''){
                            echo "<input type=\"text\" name=\"tel\" class=\"form-control\" placeholder=\"10 digitos\" value=\"$var_tel\" required>";
                            
                        }else{
                            echo "<input type=\"text\" name=\"tel\" class=\"form-control\" placeholder=\"10 digitos\" required>";
                         }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Correo electronico</label>
                        <input type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com" required>      
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" name="duda" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px" required></textarea>
                        <label for="floatingTextarea2">Duda</label>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <input type="submit" value="Enviar pregunta" class="btn btn-primary" id="enviar_pregunta">
                </div>
            </div>
        </form>
        <br>
        <h6 class="text text-danger">Sus datos se mantendran de manera segurá de acuerdo a nuestro <a href="https://markethax.com/generador-aviso-de-privacidad/">aviso de privacidad</a></h6>


    </div>

    <!-- Aqui comienza el Footer -->
    <?php
        include("footer.php");
    ?>  

</body>
<link rel="stylesheet" href="../librerias/estilos/estilos.css">
</html>