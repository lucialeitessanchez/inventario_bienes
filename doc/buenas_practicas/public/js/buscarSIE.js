$(document).ready(function () {


    $('#form_nroexpediente').mask("99999-9999999-9");

    if ($('#form_nroexpediente').val() == '') {
        $('#div_datosSie').hide();
        $('#div_datosSie_error').hide();
    } else {
        $('#div_datosSie').show();
       
    }

    if ($('#form_nroexpediente').val() != '') {

        buscarSie();
    }
    $('#form_nroexpediente').blur(buscarSie);

});
// =======================================================================
function buscarSie() {
    var nrosie = $('#form_nroexpediente').val();

    var aux_url = $('#form_nroexpediente').data('url');
    var url = aux_url.substring(0, aux_url.length - 1) + nrosie;
//alert(url);
    if (nrosie.length != 0) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (datosSie)
            {
                if (datosSie.length == 0) {
                    alert("No existe el Nro de Expediente. Verifique");
                    return;
                }
                setDatosExpte(datosSie);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
    }

}
// =======================================================================
function setDatosExpte(datosSie) {

    if (typeof datosSie !== "undefined") {
        if (typeof datosSie.remitente == "undefined") { // es porque no encontro el sie
            $("#div_datosSie_error").show();
            $("#div_datosSie").hide();
            $('#error_sie').val(datosSie.error);
          //  alert((datosSie.error).trim());

        } else {
            $("#div_datosSie_error").hide();
            $("#div_datosSie").show();
            var remitente = (datosSie.remitente).trim() + ' / ' + (datosSie.remitente_oficina).trim();
            var destino = (datosSie.destino).trim() + ' / ' + (datosSie.destino_oficina).trim();

            $('#fechaini').val(convertDateFormat(datosSie.fecha_inicio));
            $('#iniciador').val(datosSie.iniciador);
            $('#tema').val(datosSie.tema);
            $('#concepto').val(datosSie.concepto);
            $('#fechaultpase').val(convertDateFormat(datosSie.fecha_ultimo_pase));
            $('#remitente').val(remitente);
            $('#destino').val(destino);
            $('#folios').val(datosSie.folio);
            $('#agregadoa').val(datosSie.agregado_a);
           
            $('#form_fechaexpediente').val(convertDateFormat(datosSie.fecha_inicio));
           
        }
    }
}
// =======================================================================
function convertDateFormat(string) {
    var info = string.split('-');
    return info[2] + '-' + info[1] + '-' + info[0];
}
