<?php

session_start();
error_reporting(0);

$var_cliente = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$var_dir     = $_SESSION['dir'];
$var_tel     = $_SESSION['tel'];
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
                <a class="navbar-brand" href="http://143.244.172.240/hotel_sureste/">
                    <img src="../imagenes/logo.PNG" alt="" width="200" height="100">
                </a>
                <button class="btn btn-outline-secondary" type="button" disabled>Reservaciones</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='datos_cliente.php'">Datos del cliente</button>
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
        <form method="POST" action="http://143.244.172.240/hotel_sureste/models/reservar_2.php">
            <br>
            <div class="row">
                <!-- Dato habitacional -->
                <h4 class="text-center">Dato habitacional</h4>
                <br><br>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Fecha de instancia</label>
                        <input type="date" name="fecha" class="form-control" min="2021-11-01" max="2021-12-31" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group mb-3">

                            <label>Tipo de habitación</label>
                            <select class="form-select" name="habitacion" id="tipo_habit" onchange="cambio_habit()" required>
                                <option selected>Selecciona</option>
                                <option value="Suite">Suite</option>
                                <option value="Cuarto doble">Cuarto doble</option>
                                <option value="Cuarto sencillo">Cuarto sencillo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        
                        <label id="label_habit">Numero de...</label>  
                        <select class="form-select" name="num_habitacion" id="num_habitacion" required>
                        
                        </select>
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        
                        <label>Personas que se alojaran</label>
                        <input type="number" name="personas" class="form-control" min="1" max="6" required>
                    </div>
                </div>

            </div>
            <br><br>
            <!-- Método de págo -->
            <h4 class="text-center">Método de págo</h4>
            <h6 class="text-center">Tarjeta de crédito o débito</h6>
            <br>
            <div class="row">
                
                        <?php

                            echo "<div class=\"col-md-3\">
                                    <div class=\"form-group\">
                                        <label>Número de tarjeta</label>
                                        <div class=\"input-group\">
                                    ";

                            // Se lee la llave privada que se encuentra en el servidor
                            $llave = file_get_contents('../models/llaves/'.$id_usuario.'.txt');
                            if($llave){
                               
                                include("../models/obtener_tarjeta.php");
                                
                                // Desencripta la información
                                function decrypted($data, $llave){
                                    $decrypted = openssl_decrypt(base64_decode($data), 'AES-128-ECB', $llave, OPENSSL_RAW_DATA);
                                    return $decrypted;
                                }

                                $tarjeta = decrypted($datos['num_tarjeta'], $llave);
                                $tarjeta = "**************".substr($tarjeta, -2);
                                $codigo = "***";
                                $fecha = $datos['fecha'];
                                $postal = $datos['postal'];
                                
                                echo "<input type=\"text\" value=\"".$tarjeta."\" name=\"tarjeta\" class=\"form-control\" placeholder=\"16 digitos\" id=\"input_tarjeta\" maxlength=\"16\" disabled>
                                </div>
                                </div>
                                </div>";

                               echo "<div class=\"col-md-2\">
                                    <div class=\"form-group\">
                                        <label>Fecha de vencimiento</label>
                                        <input type=\"text\" value=\"".$fecha."\" name=\"fecha_vence\" class=\"form-control\" placeholder=\"MM/AA\" id=\"input_fecha\" disabled>
                                    </div>
                                </div>";

                                echo  "<div class=\"col-md-2\">
                                    <div class=\"form-group\">
                                        <label>Código de seguridad</label>
                                       
                                            <input type=\"text\" value=\"".$codigo."\" name=\"codigo\" class=\"form-control\" placeholder=\"123\" maxlength=\"3\" id=\"input_codigo\" disabled>
                                        </div>
                                </div>";

                                echo "<div class=\"col-md-2\">
                                    <div class=\"form-group\">
                                        <label>Código postal</label>
                                        <input type=\"number\" value=\"".$postal."\" name=\"postal\" class=\"form-control\" placeholder=\"29950\" id=\"input_postal\" disabled>
                                    </div>
                                </div>";


                            }else{
                                echo "<input type=\"password\"  name=\"tarjeta\" class=\"form-control\" placeholder=\"16 digitos\" id=\"input_tarjeta\" maxlength=\"16\" required>
                                <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"btn_show_tarjeta\" onclick=\"show_tarjeta()\" required>
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-eye\" viewBox=\"0 0 16 16\">
                                    <path d=\"M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z\"/>
                                    <path d=\"M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z\"/>
                                    </svg>
                                </button>
                                </div>
                                </div>
                                </div>";

                                echo "<div class=\"col-md-2\">
                                    <div class=\"form-group\">
                                        <label>Fecha de vencimiento</label>
                                        <input type=\"text\" name=\"fecha_vence\" class=\"form-control\" placeholder=\"MM/AA\" id=\"input_fecha\" required>
                                    </div>
                                </div>";

                                echo  "<div class=\"col-md-2\">
                                        <div class=\"form-group\">
                                            <label>Código de seguridad</label>
                                            <div class=\"input-group\">
                                                <input type=\"password\" name=\"codigo\" class=\"form-control\" placeholder=\"123\" maxlength=\"3\" id=\"input_codigo\" required>
                                                <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"btn_show_codigo\" onclick=\"show_codigo()\" required>
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-eye\" viewBox=\"0 0 16 16\">
                                                <path d=\"M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z\"/>
                                                <path d=\"M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z\"/>
                                                </svg>
                                                </button>
                                            </div>
                                            </div>
                                    </div>";

                                echo "<div class=\"col-md-2\">
                                    <div class=\"form-group\">
                                        <label>Código postal</label>
                                        <input type=\"number\" name=\"postal\" class=\"form-control\" placeholder=\"29950\" id=\"input_postal\" required>
                                    </div>
                                </div>";
                            }
                            

                            
                        ?>

                  
                
            </div>
            <br>
            <br>
            <!-- Boton de hacer reservación -->
            <div class="row">
                <div class="col">
                    <input type="submit" value="Hacer reservación" class="btn btn-success" id="btn_reservacion">
                </div>
            </div>
        </form>
    </div>

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