$(document).ready(function () {

    var area = $('#area').val();
    var estadoactual = $('#idestadoActual').val();
    $('.collapse')
            .on('shown.bs.collapse', function () 
    {
         
        $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    })
            .on('hidden.bs.collapse', function () {
        $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });

    if (area == 1) {
        $('#div_area5').hide();
        //$('#div_area2').hide();

        if (estadoactual == 6) {
            $('#div_area1').show();
            $('#div_adjuntar').show();
        } else {
            $('#div_area1').hide();
            $('#div_adjuntar').hide();
        }

    }
    if (area == 2) {
        $('#div_area1').hide();
        $('#div_area5').hide();
        //$('#div_area2').show();
    }
    if (area == 3) {
        $('#div_area1').hide();
        $('#div_area5').hide();
        //$('#div_area2').show();
    }
    if (area == 5) {
        $('#div_area1').hide();
        if (estadoactual == 6){
            $('#div_area1').show();
        }
        //$('#div_area2').hide();
        if (estadoactual == 8 || estadoactual == 9) {
            $('#div_area5').show();
        } else {
            $('#div_area5').hide();
        }
    }



});


// =======================================================================

