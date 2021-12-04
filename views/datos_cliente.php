<?php
session_start();

// error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$var_admin = $_SESSION['gerente'];


if($var_cliente == null || $var_cliente == ''){
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
                <button class="btn btn-outline-secondary" type="button" disabled>Datos del cliente</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='contacto.php'">Contacto</button>
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
        <!-- Información habitacional -->
        <div class="row">
            
            <div class="col-md-5">
            <h5 class="text-center">Información habitacional</h5>
            <br><br>
                <!-- Aqui se incrusta las tablas dinamicamente -->
                <?php

                include '../models/consultar_datos.php';
                echo $dato_habit;
                ?>
            </div>
                
            <div class="col-md-5 offset-md-2">
                <div class="card">
                         <!-- http://localhost/hotel_sureste/models/registrar_user.php -->
                    <form method="POST" action="https://143.244.172.240/hotel_sureste/models/editar_user.php" novalidate>
                        <h5 class="card-header text-center">Información personal</h5>
                        <div class="card-body">
                            <div class="container">
                                <br>
                                <div class="form-group">
                                    <label>Nombre de usuario</label>
                                    <input type="text" value= "<?php echo $usuario  ?>" name="usuario" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" value="<?php echo $dir ?>" name="direccion" class="form-control" placeholder="Ciudad, Colonia" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="number" value="<?php echo $tel ?>" name="tel" class="form-control" placeholder="10 dígitos" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input type="email" value="<?php echo $email ?>" name="email" class="form-control" placeholder="Ejemplo: ejemplo@gmail.com">
                                </div>
                                <br>
                                <label>Contraseña</label>
                                <div class="input-group">
                                    <input type="password" value="<?php echo $pass ?>" name="pass" class="form-control" id="input_pass_nuevo">
                                    <button class="btn btn-outline-secondary" type="button" id="btn_show_nuevo" onclick="show_pass_nuevo()">Ver</button>
                                </div>
                                <br>
                                <label>Numero de tarjeta</label>
                                <div class="input-group"> 
                                    <input type="password" value="<?php echo $num_tarjeta ?>"  name="tarjeta" class="form-control" placeholder="16 digitos" id="input_tarjeta" maxlength="16">
                                    <button class="btn btn-outline-secondary" type="button" id="btn_show_tarjeta" onclick="show_tarjeta()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z\"/>
                                        </svg>
                                    </button>  
                                    
                                </div>
                                <br>
                                <div class="form-group">
                                        <label>Fecha de vencimiento</label>
                                        <input type="text\" value="<?php echo $fecha ?>" name="fecha_vence" class="form-control" placeholder="MM/AA" id="input_fecha" required>
                                </div>
                                <br>

                                <label>Código de seguridad</label>
                                <div class="input-group">
                                    <input type="password" value="<?php echo $codigo ?>" name="codigo" class="form-control" placeholder="123" maxlength="3" id="input_codigo">
                                    <button class="btn btn-outline-secondary" type="button" id="btn_show_codigo" onclick="show_codigo()" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z\"/>
                                    </svg>
                                    </button>
                                </div>
                                <br>

                                <div class="form-group">
                                        <label>Código postal</label>
                                        <input type="number" value="<?php echo $postal ?>" name="postal" class="form-control" placeholder="29950" id="input_postal" required>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 offset-md-4">
                                        <input type="submit" value="Guardar" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <br><br>
        <br>
        <br>
    </div>


    <!-- Aqui comienza el Footer -->
    <?php
    include("footer.php");
     ?>
</body>
<link rel="stylesheet" href="../librerias/estilos/estilos.css">

</html>