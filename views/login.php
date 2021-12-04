<?php

session_start();
error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$var_admin = $_SESSION['gerente'];
$var_error = $_SESSION['error_login'];

if($var_cliente != null | $var_cliente != ''){
    header("Location:datos_cliente.php");    
}

if($var_admin != null | $var_admin != ''){
    header("Location:administracion.php");    
}

// if($var_error != null | $var_error != ''){
//     header("Location:administracion.php");    
// }


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

<body>

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

            </form>
        </div>

    </nav>



    <!-- Contenido de la página -->
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true'){
                echo "<h4 class=\"text-danger text-center\">Usuario o contraseña invalido</h4>";
                }
               
                if(isset($_GET["registro"]) && $_GET["registro"] == 'true'){
                echo "<h4 class=\"text-success text-center\">¡Registrado correctamente!</h4>";
                }
                ?>
                <div class="card">
                    <form method="POST" action="https://143.244.172.240/hotel_sureste/models/sesion_login.php">
                        <h5 class="card-header">Ingrese sus datos de acceso</h5>
                        <div class="card-body">
                            <div class="container">
                                <br>
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" name="pass" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 offset-md-4">
                                        <input type="submit" value="Ingresar" class="btn btn-primary">
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

    <!-- Aqui comienza el Footer -->
    <?php
        include("footer.php");
    ?>



</body>
<link rel="stylesheet" href="../librerias/estilos/estilos.css">

</html>