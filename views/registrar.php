<?php

session_start();

error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$var_admin = $_SESSION['usuario'];


if($var_cliente != null | $var_cliente != ''){
    header("Location:datos_cliente.php");    
}

if($var_admin != null | $var_admin != ''){
    header("Location:administracion.php");    
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
                <a class="navbar-brand" href="http://143.244.172.240/hotel_sureste/">
                    <img src="../imagenes/logo.PNG" alt="" width="200" height="100">
                </a>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='reservaciones.php'">Reservaciones</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='datos_cliente.php'">Datos del cliente</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='contacto.php'">Contacto</button>
                <?php 
                if($var_admin !== null || $var_admin != ''){
                    echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='administracion.php'\">Mensajes</button>";
                }
                if($var_cliente !== null || $var_cliente != ''){
                echo "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"location.href='../models/cerrar_sesion.php'\">Cerrar sesión</button>";
                }
                
                ?>


            </form>
        </div>

    </nav>




    <div class="container">
        <br><br>
        <?php
                if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true'){
                echo "<h4 class=\"text-danger text-center\">Carácter invalido</h4>";
                }
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <form method="POST" action="http://143.244.172.240/hotel_sureste/models/registrar_user.php">
                        <h5 class="card-header">Ingrese sus datos de registro</h5>
                        <div class="card-body">
                            <div class="container">
                                <br>
                                <div class="form-group">
                                    <label>Nombre de usuario</label>
                                    <input type="text" name="usuario" class="form-control" pattern="[A-Za-z]" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" class="form-control" pattern="[A-Za-z]" placeholder="Ciudad, Colonia" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="number" name="tel" class="form-control" placeholder="10 dígitos" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input type="email" name="email" class="form-control" placeholder="Ejemplo: ejemplo@gmail.com" required>
                                </div>
                                <br>
                                <label>Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="input_pass_nuevo">
                                    <button class="btn btn-outline-secondary" type="button" id="btn_show_nuevo" onclick="show_pass_nuevo()" required>Ver</button>
                                </div>
                                <br>
                                <label>Repite la contraseña</label>
                                <div class="input-group"> 
                                    <input type="password" name="pass" class="form-control" id="input_pass_compr" onchange="validar_pass(this)" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btn_show_compr" onclick="show_pass_compr()" >Ver</button>
                                </div>
                                <div class="text-danger" id="mensaje_pass"></div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 offset-md-4">
                                        <input type="submit" value="Registrarme" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <h6 class="text text-danger">Sus datos se mantendran de manera segurá de acuerdo a nuestro <a href="https://markethax.com/generador-aviso-de-privacidad/">aviso de privacidad</a></h6>

    </div>
    <br>







    <!-- Aqui comienza el Footer -->
    <footer class="footer bg-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col">

                    <h4 class="text-white">HOTEL SURESTE</h4>
                    <ul>
                        <li><a class="text-white" href="#">Cookies</a></li>
                        <li><a class="text-white" href="#">Política de privacidad</a></li>
                        <li><a class="text-white" href="#">Aviso legal</a></li>
                        <li><a class="text-white" href="#">Términos y condiciones</a></li>
                    </ul>

                </div>
                <div class="col">

                    <h4 class="text-white">SIGUENOS EN</h4>
                    <ul>
                        <li><a class="text-white" href="#">Facebook</a></li>
                        <li><a class="text-white" href="#">Instagram</a></li>
                        <li><a class="text-white" href="#">Pinterest</a></li>
                        <li><a class="text-white" href="#">Twitter</a></li>
                        <li><a class="text-white" href="#">WhatsApp</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <br>
                        <li>
                            <p class="text-white">Hotel Sureste. © 2021</p>
                        </li>
                        <li><a class="text-white" href="#">www.HotelSureste.com</a></li><br>
                        <li>
                            <p class="text-white">Desarrollado por Equipo 5, 7A IDyGS </p>
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <ul><br>
                        <li>
                            <h5 class="text-white">Gracias por su estancia. ¡Vuelva pronto!</h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>
<link rel="stylesheet" href="../librerias/estilos/estilos.css">
</html>