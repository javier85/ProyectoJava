$(document).ready(function () {
    datos();
    // $(".toast").toast("show");
});

//Valida Campos vacios en en formulario insert_paciente.php 
function validation() {
    //Variables con valores de cada input del formulario
    var nombre = $("#txtnombre").val();
    var direccion = $("#txtdireccion").val();
    var tel = $("#txttel").val();
    var nacimiento = $("#txtnacimiento").val();
    var genero = $("#txtgenero").val();
    var eps = $("#txteps").val();
    var documento = $("#txtdocumento").val();
    var estado = $("#txtestado").val();

    //Validacion
    if (nombre == "" || direccion == "" || tel == "" || genero == "0" || nacimiento == "" || eps == "" || eps == "0" || documento == "" || estado == "") {

        $("#txtnombre").attr("placeholder", "Ingrese un nombre"); //Cambia color de placeholder
        $("#txtnombre").addClass("val"); //Cambia color del placeholder

        $("#txtdocumento").attr("placeholder", "Ingrese un documento");
        $("#txtdocumento").addClass("val");

        $("#txtdireccion").attr("placeholder", "Ingrese una dirección");
        $("#txtdireccion").addClass("val");

        $("#txttel").attr("placeholder", "Ingrese un teléfono");
        $("#txttel").addClass("val");

        $("#txtestado").attr("placeholder", "Ingrese un estado valido");
        $("#txtestado").addClass("val");

        if (genero == "0") {
            $("#selectGenero").css("color", "red");
        } else {
            $("#selectGenero").css("color", "black");
        }

        $("#txteps").attr("placeholder", "Ingrese una eps");
        $("#txteps").addClass("val");


        if (nacimiento == "") {
            $("#txtnacimiento").css("color", "red");
        } else {
            $("#txtnacimiento").css("color", "black");
        }

        if (eps == "0") {
            $("#txteps").css("color", "red");
        } else {
            $("#txteps").css("color", "black");
        }

        return true; //Evita que envie el formulario
    }

}

// Limpia los campos
function LimpiarCampos() {

    $("#txtnombre").val("");
    $("#txtdireccion").val("");
    $("#txttel").val("");
    $("#txtnacimiento").val("");
    $("#selectGenero").val("0");
    $("#txteps").val("");
    $("#txtdocumento").val("");
    $("#txtestado").val("");

}

// Lista de eps 

var dominio = location.protocol + '//' + location.hostname + ':' + location.port + '//senamaseps';

//https://www.datos.gov.co/resource/ctqd-7qev.json
function datos() {
    $.ajax({
        method: "GET",
        url: dominio + "/js/epslist.json",
        success: function (data) {
            $(data).each(function (index) {
                $("#txteps").append('<option value="' + data[index].nombre + '">' + data[index].nombre + '</option>');

            });

        },
        error: function () {
            $("#epsdatos").children().remove();
            $("#epsdatos").html('<label for="txteps">EPS</label>' +
                '<input type = "text" class ="form-control" name = "txteps" id = "txteps" placeholder = "EPS" >');

        }
    });

}


//Agregar usuarios
$("#sendDatos").click(function () {

    if (validation()) {

        validation();

    } else {

        var opcion = $("#txtopcion").val();
        var documento = $("#txtdocumento").val();
        var nombre = $("#txtnombre").val();
        var direccion = $("#txtdireccion").val();
        var telefono = $("#txttel").val();
        var fecha_nacimiento = $("#txtnacimiento").val();
        var estado = $("#txtestado").val();
        var genero = $("#selectGenero").val();
        var eps = $("#txteps").val();

        $.ajax({
            method: "POST",
            url: "pacienteProcess.php",
            data: {
                txtopcion: opcion,
                txtdocumento: documento,
                txtnombre: nombre,
                txtdireccion: direccion,
                txttel: telefono,
                txtnacimiento: fecha_nacimiento,
                txtestado: estado,
                selectGenero: genero,
                txteps: eps,
            },
            success: function (response) {
                $('#crearusu').modal('hide');
                $(".toast").toast("show");
                $('time.timeago').attr("datetime", iso8601(new Date()));
                console.log($("time.timeago").timeago());
                $("#toastMen").html(response);
                actualizarPag();
            },
            error: function (rest) {
                $('#crearusu').modal('hide');
            }
        });

        LimpiarCampos();

    }


});



//Ver usuario

$(".verDatos").click(function () {
    var opcion = "visualizar";
    var documento = $(this).attr('id');

    $.ajax({
        method: "POST",
        url: "pacienteProcess.php",
        data: {
            txtopcion: opcion,
            verDatos: documento,

        },
        success: function (response) {
            $("#MostrarPaciente").html(response);
            // $("#MostrarPaciente").text(response);

        },
        error: function (rest) {
            $("#MostrarPaciente").html(rest);

        }
    });

});

$(".verClose").click(function () {
    $("#MostrarPaciente").empty();

});



// Muestra el paciente a editar en un modal

$(".editPaciente").click(function () {

    var opcion = "showedit";
    var documento = $(this).attr('id');

    $.ajax({
        method: "POST",
        url: "pacienteProcess.php",
        data: {
            txtopcion: opcion,
            verDatos: documento,

        },
        success: function (response) {
            $("#Showpaciente").html(response);
            // $("#MostrarPaciente").text(response);

        },
        error: function (rest) {
            $("#Showpaciente").html(rest);

        }
    });


});

// Envia los datos del modal al paciente process para editar

$("#sendEdit").click(function () {
    var opcion = "editar";
    var documentoviejo = $("#txtdocumentoviejo").val();
    var documentonuevo = $("#txtdocumentonuevo").val();
    var nombre = $("#txtnombrenuevo").val();
    var direccion = $("#txtdireccionnueva").val();
    var telefono = $("#txttelnuevo").val();
    var fecha_nacimiento = $("#txtnacimientonuevo").val();
    var estado = $("#txtestadonuevo").val();
    var genero = $("#selectGeneronuevo").val();
    var eps = $("#epsdatosnuevo").val();

    $.ajax({
        method: "POST",
        url: "pacienteProcess.php",
        data: {
            txtopcion: opcion,
            txtdocumentoviejo: documentoviejo,
            txtdocumentonuevo: documentonuevo,
            txtnombrenuevo: nombre,
            txtdireccionnueva: direccion,
            txttelnuevo: telefono,
            txtnacimientonuevo: fecha_nacimiento,
            txtestadonuevo: estado,
            selectGeneronuevo: genero,
            epsdatosnuevo: eps,
        },
        success: function (response) {
            $('#modaleditar').modal('hide');
            $(".toast").toast("show");
            $('time.timeago').attr("datetime", iso8601(new Date()));
            console.log($("time.timeago").timeago());
            $("#toastMen").html(response);
            actualizarPag();
        },
        error: function (rest) {
            $('#crearusu').modal('hide');
        }
    });

});


// Elimina el paciente 

var documento;
$(".deletePaciente").click(function () {
    documento = $(this).attr('id');
    $('.del').html('¿Desea eliminar el paciente <strong style="color:blue" >' + documento + '</strong> ?');
    $(".deleteSend").click(function () {

        $.ajax({
            method: "POST",
            url: "pacienteProcess.php",
            data: {
                txtopcion: "eliminar",
                txtdocumento: documento,

            },
            success: function (response) {
                $('#EliminarPaciente').modal('hide');
                $(".toast").toast("show");
                $('time.timeago').attr("datetime", iso8601(new Date()));
                console.log($("time.timeago").timeago());
                $("#toastMen").html(response);
                actualizarPag();
            },
            error: function (rest) {
                $('#EliminarPaciente').modal('hide');
            }
        });

    });


});

function actualizarPag() {
    setTimeout(function () { window.location.reload(false); }, 6000);

}