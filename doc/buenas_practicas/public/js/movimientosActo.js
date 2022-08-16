$(document).ready(function () {

    $('#nroexpediente').mask("99999-9999999-9");

    $('#form_buscarActo').click(buscarDatos2);
    // alert($('#institucion').length);
    if ($('#institucion').val() == '') {
        $('#div_datosencontrados').hide();
    } else {
        $('#div_datosencontrados').show();
    }


});
//-----------------------------------------------------------

function buscarDatos2() {

    //var nroNota = $('#nroNota').val();
    var nroexpediente = $('#nroexpediente').val();
    var idActoAdministrativo = $('#idActoAdministrativo').val();


    if (nroexpediente.length === 0) {
        nroexpediente = 0;
    }
    if (idActoAdministrativo.length === 0) {
        idActoAdministrativo = 0;
    }
    if (nroexpediente == 0 && idActoAdministrativo == 0) {

        alert("DEBE INGRESAR ALGÚN CRITERIO DE BÚSQUEDA - VERIFIQUE");
    } else {

        aux_url = $('#form_buscarActo').data('url');
        // alert(aux_url);
        url = aux_url.substring(0, aux_url.length - 3) + nroexpediente + "/" + idActoAdministrativo;
        // alert(url);

        //if (idActoAdministrativo != '') {

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (datos)
            {
                if (datos.length == 0) {
                    alert("No se encontro ningún ACTO ADMINISTRATIVO coincidente o su Estado no permite movimientos. Verifique");
                    return;
                }
                setDatos(datos);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
        //  } else
        //    setDatos();
    }
}

// =======================================================================

// -- seteo datos 
function setDatos(datos) {
    // alert("setear datos");
    //console.log(datos);

    if (typeof datos !== "undefined") {
        //$.each(arrdatos, function (index, datos) {
        $('#div_datosencontrados').show();
        $('#institucion').val(datos.institucion);

        if (datos.nronota === null) {
            $('#nota').val('');
        } else {
            $('#nota').val(datos.nronota);
        }

        if (datos.fechanota !== "undefined") {
            $('#fnota').val(datos.fechanota);
        }

        $('#idActoAdministrativo').val(datos.nroacto);
        $('#form_nroexpediente').val(datos.nroexpediente);
        $('#fexpediente').val(datos.fechaexpediente);
        $('#caratula').val(datos.caratula);
        $('#fcaratula').val(datos.fechacaratula);
        $('#fechadictamen').val(datos.fechadictamen);
        $('#observaciondictamen').val(datos.observaciondictamen);
        // $('#tabla_componente').append('<tr><td style="width: 20%; text-align: left">Componente</td></tr>');

        $.each(datos.componente, function (index, unCompo) {

            $('#tabla_componente').append('<tr><td style=" font-weight:bold;width: 75%;">' + unCompo + '</td>\n\
                                    </tr>');
        });
        $('#componentesolicitado').val(datos.componente);
        $('#montoaprobado').val(datos.montoaprobado);
        $('#montosolicitado').val(datos.montosolicitado);
        $('#fechamontoaprobado').val(datos.fechamontoaprobado);
        $('#areacarga').val(datos.area_carga);
        $('#estadotramite').val(datos.estado_actual);

        if ($('#form_nroexpediente').val() != '') {
            $('#form_nroexpediente').blur();
            $('#fexpediente').blur();
            // buscarSie();->lo saco porque agregue el buscaSie.js y lo busca dsde ahi

        }
        // });
    }

}
// =======================================================================




