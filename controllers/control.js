function show_login() {
    window.location.href = "https://143.244.172.240/hotel_sureste/views/login.php";
}


function crear_llave_privada() {
    window.location.href = "https://143.244.172.240/hotel_sureste/models/crear_llave_priv.php";
}


function show_mensaje(este) {
    var id_mensaje = $(este).data('id_mens');
    window.location.href = 'https://143.244.172.240/hotel_sureste/views/ver_mensaje.php?id=' + id_mensaje;
}

function descifrar_mens(mensaje) {


    // var file_llave = $('#file_llave').val();
    var fileInputElement = document.getElementById("file_llave").files[0];
    var mensaje = $('#mensaje_encriptado').text();
    var text = null;

    if (window.File && window.FileReader && window.FileList && window.Blob) {
        console.log(fileInputElement);
        var reader = new FileReader();

        reader.addEventListener('load', function() {
            text = this.result;
        });

        reader.readAsText(fileInputElement);
        console.log(text);
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }


    $.ajax({
        url: 'https://143.244.172.240/hotel_sureste/models/descifrar_mensaje.php',
        data: { mensaje: mensaje, llave_privada: llave_privada },
        type: 'POST',
        dataType: 'text',
        success: function(data) {

            $('#div_mensaje').text(data);

        },
        error: function(xhr, status) {
            console.log('Error: ' + xhr.status);
        },
    });

}


function show_registrar() {
    window.location.href = "https://143.244.172.240/hotel_sureste/views/registrar.php";

}

// Cambia el numero de habitación
function cambio_habit() {
    var tipo_habit = document.getElementById("tipo_habit").value;
    var label_habit = document.getElementById("label_habit");

    $('#num_habitacion').empty();

    if (tipo_habit == 'Selecciona') {
        label_habit.innerHTML = "Numero de ...";
    } else {
        label_habit.innerHTML = "Numero de " + tipo_habit;

        $.ajax({
            url: 'https://143.244.172.240/hotel_sureste/models/validar_habitacion.php',
            data: { habitacion: tipo_habit },
            type: 'POST',
            dataType: 'html',
            success: function(data) {
                $('#num_habitacion').append(data);
            },
            error: function(xhr, status) {
                console.log('Error: ' + xhr.status);
            },
        });

    }

}

var estado_input = true;

//muestra la contraseña
function show_pass() {
    if (estado_input) {
        $('#input_pass').attr("type", "text");
        estado_input = false;
        $('#btn_show').text('Ocultar');
    } else {
        $('#input_pass').attr("type", "password");
        estado_input = true;
        $('#btn_show').text('Ver');
    }
}

//Termina una reservación
function fin_reservacion() {
    var btn_fin = $('#fin_reservacion');
    var tipo = btn_fin.data('tipo');
    var cliente = btn_fin.data(('cliente'));

    $.ajax({
        url: 'https://143.244.172.240/hotel_sureste/models/fin_reservacion.php',
        data: { tipo: tipo, cliente: cliente },
        type: 'POST',
        dataType: 'text',
        success: function(data) {
            console.log(data);
            location.reload();
        },
        error: function(xhr, status) {
            console.log('Error: ' + xhr.status);
        },
    });
}

var llave_privada = "";
//Lee la llave privada
function read_llave(este) {
    llave_privada = $(este).val();
}

// Descifra
function descifrar() {

    $('#llave_priv').val('');
    var cliente = $('#btn_descifrar').data('cliente');

    $.ajax({
        url: 'https://143.244.172.240/hotel_sureste/models/mostrar_datos_bancarios.php',
        data: { cliente: cliente, llave_privada: llave_privada },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            console.log(data);

            $('#input_tarjeta').val(data.tarjeta);
            $('#input_fecha').val(data.fecha);
            $('#input_codigo').val(data.codigo);
            $('#input_postal').val(data.postal);

        },
        error: function(xhr, status) {
            console.log('Error: ' + xhr.status);
        },
    });

}

function validar_pass(este) {
    var pass_nuevo = $('#input_pass_nuevo').val();
    var pass_compr = $(este).val();
    if (pass_nuevo.length < 6) {
        $('#mensaje_pass').text("Contraseña muy corta");
    } else {
        $('#mensaje_pass').text("");

        if (pass_nuevo != pass_compr) {
            $('#mensaje_pass').text("Las contraseñas no son iguales");
        } else {
            $('#mensaje_pass').text("");
        }
    }
}


var estado_pass_nuevo = true;
//muestra la contraseña en módulo registros
function show_pass_nuevo() {
    if (estado_pass_nuevo) {
        $('#input_pass_nuevo').attr("type", "text");
        estado_pass_nuevo = false;
        $('#btn_show_nuevo').text('Ocultar');
    } else {
        $('#input_pass_nuevo').attr("type", "password");
        estado_pass_nuevo = true;
        $('#btn_show_nuevo').text('Ver');
    }
}


var estado_pass_compr = true;
//muestra la contraseña de comprobar en módulo registros
function show_pass_compr() {
    if (estado_pass_compr) {
        $('#input_pass_compr').attr("type", "text");
        estado_pass_compr = false;
        $('#btn_show_compr').text('Ocultar');
    } else {
        $('#input_pass_compr').attr("type", "password");
        estado_pass_compr = true;
        $('#btn_show_compr').text('Ver');
    }
}

var estado_tarjeta = true;
//muestra la tarjeta en el modulo reservaciones
function show_tarjeta() {
    if (estado_tarjeta) {
        $('#input_tarjeta').attr("type", "text");
        estado_tarjeta = false;
    } else {
        $('#input_tarjeta').attr("type", "password");
        estado_tarjeta = true;
    }
}

var estado_codigo = true;

function show_codigo() {
    if (estado_codigo) {
        $('#input_codigo').attr("type", "text");
        estado_codigo = false;
    } else {
        $('#input_codigo').attr("type", "password");
        estado_codigo = true;
    }
}