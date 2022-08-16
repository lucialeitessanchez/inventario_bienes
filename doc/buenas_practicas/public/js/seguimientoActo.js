$(document).ready(function () {

   $('#form_filtrarExpediente').mask("99999-9999999-9");
   
    $('#form_buscarActo').click(buscarDatos2);
    $('#nroexpediente').blur(buscarSie);
    $('#form_nombreinstitucion').select2();
    // mostrarComponentes();

    $('#form_idestado').change(function () {
        $('#form_filtrarEstado').val($('#form_idestado').val());
        $('#seguimiento').submit();
    });

    $('#form_filtrarLista').click(function () {
      
     $('#form_filtrarEstado').val($('#form_idestado').val());
        $('#form_filtrar').val(1);
    });




});


// =======================================================================
function buscarDatos2() {

    var nroNota = $('#nroNota').val();
    var nroexpediente = $('#nroexpediente').val();
    var idActoAdministrativo = $('#idActoAdministrativo').val();

    if (nroNota.length === 0) {
        nroNota = 0;
    }
    if (nroexpediente.length === 0) {
        nroexpediente = 0;
    }
    if (idActoAdministrativo.length === 0) {
        idActoAdministrativo = 0;
    }

    aux_url = $('#form_buscarActo').data('url');
    url = aux_url.substring(0, aux_url.length - 5) + nroNota + "/" + nroexpediente + "/" + idActoAdministrativo;
    //alert(url);

    if (idActoAdministrativo != '') {

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (datos)
            {
                if (datos.length == 0) {
                    alert("No se encontro ningún ACTO ADMINISTRATIVO coincidente. Verifique");
                    return;
                }
                setDatos(datos);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
    } else
        setDatos();
}
// =======================================================================

function justNumbers(e)
{
    //var keynum1 = window.event ? window.event.keyCode : e.which;
    var keynum = e.which || e.keyCode;

    // 8: backspace/delete -- 46: delete (punto)
    if ((keynum == 8) || (keynum == 46))
        return true;

    // 9: tab -- 13: enter
    if ((keynum == 9) || (keynum == 13))
        $('#form_montototalsolicitud').blur();

    return /\d/.test(String.fromCharCode(keynum));
}

// =======================================================================

// -- seteo datos 
function setDatos(datos) {

    // $('#form_instId').empty();
    //$('#form_instId').append($('<option value="">SELECCIONE</option>'));
    console.log(datos);
    if (typeof datos !== "undefined") {
        $('#div_datosencontrados').show();
        $('#institucion').val(datos.instNombre);
        if (lenght(datos.nroNota) === 0) {
            $('#nota').val('');
        } else {
            $('#nota').val(datos.nroNota);
        }
        if (lenght(datos.fechanota) === 0) {
            $('#fnota').val('');
        } else {
            $('#fnota').val(datos.fechanota);
        }
        $('#nroexpediente_acto').val(datos.nroexpediente_acto);
        $('#fexpediente').val(datos.fexpediente);
        $('#caratula').val(datos.caratula);
        $('#fcaratula').val(datos.fcaratula);
        $('#montoaprobado').val(datos.montoaprobado);
        $('#montosolicitado').val(datos.montosolicitado);
        $('#estadotramite').val(datos.estadotramite);
    }

}
// =======================================================================

function mostrarComponentes()
{
    var idActo = $('#idactoadministrativo').val();
    //buscar para el acto administrativo la lista de componentes

    aux_url = $('#form_detallecomponenteIddetallecomponentesolicitado').data('url');
    if (aux_url != 'undefined') {
        url = aux_url.substring(0, aux_url.length - 1) + idActo;

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (listacomponentes)
            {
                if (listacomponentes.length != 0) {

                    $('#form_detallecomponenteIddetallecomponentesolicitado').val(listacomponentes);
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
    }
}

function buscarSie() {
    var nrosie = $('#nroexpediente').val();

    var aux_url = $('#nroexpediente').data('url');
    var url = aux_url.substring(0, aux_url.length - 1) + nrosie;

    if (nrosie.length != 0) {
        alert(nrosie);
        alert(url);
    }
}