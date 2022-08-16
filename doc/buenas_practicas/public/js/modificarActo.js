$(document).ready(function () {

    cargarLocalidad();
    cargarInstitucion();
    mostrarCheckRequisitos();

  $('#form_cbuinstitucion').mask("9999999999999999999999");

    // buscarInstituciones();
    if ($('#form_instId').length == 0) {
        $('#div_datosInstitucion').hide();
    } else {
        $('#div_datosInstitucion').show();
        mostrarDatosInstitucion();
    }
    if ($('#idactoadministrativo').val() == 0) {
        $('#div_montoAprobado').hide();
        $('#div_estado').hide();
        $('#div_estado_nvo').hide();
    } else {
        $('#div_montoAprobado').show();
        $('#div_estado').show();
        $('#div_estado_nvo').show();
    }

    $('#form_localidad').select2();
    $('#form_localidad').change(buscarInstituciones);
    $('#form_instId').select2();
    $('#form_instId').change(mostrarDatosInstitucion);
    $('#form_nroexpediente').blur(buscarSie);
    mostrarComponentes();
});
// =======================================================================

function cargarLocalidad() {
    $('#form_localidad').val(localidad_id);
}
function cargarInstitucion() {
    $('#form_instId').val(institucion_id);
}
function buscarInstituciones() {

    //var tiposolicitante = $('#form_tiposolicitanteIdtiposolicitante').val();
    var localidad = $('#form_localidad').val();
    $('#tabla_inst').empty();
    // -- institucion/ getInstitucionPorLocTipo
    aux_url = $('#form_localidad').data('url');
    url = aux_url.substring(0, aux_url.length - 1) + localidad;
    if (localidad != '') {

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (instituciones)
            {
                if (instituciones.length == 0) {
                    alert("No existen INSTITUCIONES relacionados a la LOCALIDAD seleccionada. Verifique");
                    return;
                }
                setInstituciones(instituciones);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
    } else
        setInstituciones();
}

//-----------------------------------------------------------
// -- seteo combo INSTITUCION
function setInstituciones(instituciones) {

    $('#form_instId').empty();
    $('#form_instId').append($('<option value="">SELECCIONE</option>'));
    if (typeof instituciones !== "undefined") {
        $.each(instituciones, function (index, unaInstitucion) {
            $('#form_instId').append($('<option value="' + unaInstitucion.id + '" >' + unaInstitucion.text + '</option>'));
        });
    }

}
// =======================================================================

//-----------------------------------------------------------
// -- seteo combo COMPONENTE DETALLE
function setComboComponente(combocomponente) {//no lo uso porque sobreescribia los datos al armar el form y guardaba mal. 
    //VERO COMO LO ARMO GUSTAVO EN LA ENTIDAD DETALLECOMPONENTE (JUNTA VARIOS CAMPOS)

    $('#form_arrayComponenteDescripcion').empty();

    if (typeof combocomponente !== "undefined") {

        $.each(combocomponente, function (index, unComponente) {
            $('#form_arrayComponenteDescripcion').append($('<option value=' + unComponente.id + '>' + unComponente.text + '</option>'));
        });
    }
//alert($('#form_arrayComponenteDescripcion'));

}

// =======================================================================

function mostrarDatosInstitucion() {

    var idInstitucion = $('#form_instId').val();
    // -- institucion/ getDatosInstitucion
    aux_url = $('#form_instId').data('url');
    url = aux_url.substring(0, aux_url.length - 1) + idInstitucion;
    if (idInstitucion != '') {

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (datosInstitucion)
            {
                if (datosInstitucion.length == 0) {
                    alert("No existe la INSTITUCION selacionada. Verifique");
                    return;
                }
                setInstitucionSeleccionada(datosInstitucion);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown)
            {
                alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
            }
        });
    } else
        setInstitucionSeleccionada();
}

//-----------------------------------------------------------

//-----------------------------------------------------------
// -- seteo institucion Seleccionada
function setInstitucionSeleccionada(datosInstitucion) {
    $('#tabla_inst').empty();
    $("#div_datosInstitucion").show();

    if (typeof datosInstitucion !== "undefined") {
        var domicilio = datosInstitucion.instDirCalle + ' ' + datosInstitucion.instDirNro;
        $('#nrorong').val(datosInstitucion.instNroRong);
if (datosInstitucion.nroSipaf!=="undefined")
            $('#nroSipaf').val(datosInstitucion.nroSipaf);
        
        $('#domicilio').val(domicilio);
        $('#instTelefono').val(datosInstitucion.instTelefono);
        $('#comdirFecIni').val(datosInstitucion.comdirFecIni);
        $('#comdirFecFin').val(datosInstitucion.comdirFecFin);
        
        $('#tabla_inst').append('<tr><td style="width: 10%; text-align: left"></td>\n\
    <td style="width: 35%; text-align: left"><b>Apellido y Nombres</b></td>\n\
    <td style="width: 20%; text-align: left"><b>Documento</b></td>\n\
    <td style="width: 25%; text-align: left"><b>Cargo</b></td>\n\
    <td style="width:40%;text-align: left"><b>Contacto</B></td>\n\
    </tr>');

        if (typeof datosInstitucion.autoridades !== "undefined") {
            var i = 0;
            $.each(datosInstitucion.autoridades, function (index, autoridad) {
                i++;
                var contacto = '';

                if (autoridad.autTelefono != null)
                    contacto = contacto + autoridad.autTelefono;
                if (autoridad.autCelular != null)
                    contacto = contacto + autoridad.autCelular;
                if (autoridad.autMail != null)
                    contacto = contacto + autoridad.autMail;

                $('#tabla_inst').append('<tr><td style="width: 10%; text-align: left"></td>\n\
                                    <td style=" width: 35%;">' + autoridad.apenom + '</td>\n\
                                    <td style=" width: 20%;">' + autoridad.documento + '</td>\n\
                                    <td style=" width: 25%;">' + autoridad.cargo + '</td>\n\
                                    <td style=" width: 40%;">' + contacto + '</td>\n\
                                    </tr>');
            });
        }
    }
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

// ========================================================================

function mostrarComponentes()//los solicitados
{
    var idActo = $('#idactoadministrativo').val();
    //buscar para el acto administrativo la lista de componentes
    aux_url = $('#form_detallecomponenteIddetallecomponentesolicitado').data('url');
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

// =======================================================================
function mostrarCheckRequisitos()
{
    var idActo = $('#idactoadministrativo').val();
    //buscar para el acto administrativo la lista de componentes
    //aux_url = $('#form_checkrequisitosIdcheckrequisitos').data('url');
    aux_url = $('#form_detallerequisito').data('url');
    url = aux_url.substring(0, aux_url.length - 1) + idActo;
//alert(url);
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (listarequisitos)
        {
            if (listarequisitos.length != 0) {

                //      $('#form_detallerequisito').val(listarequisitos);
                //  $('#form_detallerequisito').val(1).checked='checked' ;

                $.each(listarequisitos, function (index, unRequisito) {
                    //    alert(unRequisito);
                    //$('#form_detallerequisito_0').val(unRequisito);
                    //alert(index);

                    for (var i = 0; i < 15; i++) {
                        //n += i;
                        //mifuncion(n);
                        if ($('#form_detallerequisito_' + i).val() == unRequisito) {
                            $('#form_detallerequisito_' + i).attr('checked', true);
                        }
                    }

                });
            }
        },
        error: function (XmlHttpRequest, textStatus, errorThrown)
        {
            alert("Se Produjo un error al cargar la pagina. Consulte con el Administrador " + textStatus);
        }
    });

}

// =======================================================================