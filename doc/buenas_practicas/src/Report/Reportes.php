<?php

namespace App\Report;

class Reportes extends \TCPDF {

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false) {

        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);


// activa o desactiva encabezado de página
        $this->SetPrintHeader(true);

// activa o desactiva el pie de página
        $this->SetPrintFooter(true);

        $this->SetFont('times', '', 10);
        $this->setPageOrientation($orientation);

// set default header data

        $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $this->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $this->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $this->SetAutoPageBreak(TRUE, 15);

// set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->AddPage();
    }

// ----------------------------------------    
// -- Page header
    public function Header() {
// -- Logo
        $image_file = 'img/encabezado.jpg';
        $this->Image($image_file, 100, 10, 200, 15, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

// ----------------------------------------
// Page footer
    public function Footer() {
// Position at 15 mm from bottom
        $this->SetY(-15);
// Set font
        $this->SetFont('helvetica', 'I', 8);
// Page number, fecha generacion
        $fechaGen = new \Datetime("now");

        $this->Cell(80, 15, 'Fecha generacion: ' . $fechaGen->format('d-m-Y H:i:s'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(180, 15, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

// ---------------------------------------- 
    public function printReport_EvaluarSecretario($arr_imprimir) {

        if (count($arr_imprimir) > 0) {

            $this->SetFont('helvetica', 'B', 10);
            $this->MultiCell(180, 6, "BUENAS PRÁCTICAS SOCIALES", 0, '', 0, 1, '', '', true);
            $this->Ln(1);
            $this->Ln(1);

            $this->MultiCell(180, 6, "Solicitudes para ser evaluadas por el Secretario", 0, '', 0, 1, '', '', true);
            $this->Ln(1.5);

            $this->SetFont('helvetica', '', 8);
            $this->MultiCell(10, 8, "Nro Acto", 1, 'LBR', 0, 0, '', '', true, '', 'B');

            //$this->MultiCell(20, 5, "NRO EXPEDIENTE", 1, '', 0, 0, '', '', true);
            $this->MultiCell(70, 8, "Institución", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 8, "Localidad", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 8, "Departamento", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(17, 8, "$ Solicitado", 1, 'C', 0, 0, '', '', true);
            //$this->MultiCell(30, 8, "Componente", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(40, 8, "Referente", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(30, 8, "Estado", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(18, 8, "Fecha ingreso", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(20, 8, "Respuesta", 1, 'C', 0, 1, '', '', true);

            $this->SetFont('helvetica', '', 8);
            for ($i = 0; $i < count($arr_imprimir); $i++) {
                $this->MultiCell(10, 17, $arr_imprimir[$i]['nroacto'], 1, 'R', 0, 0, '', '', true);
                $this->MultiCell(70, 17, $arr_imprimir[$i]['institucion'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 8, $arr_imprimir[$i]['localidad'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 8, $arr_imprimir[$i]['departamento'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(17, 8, $arr_imprimir[$i]['montosolicitado'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(40, 8, $arr_imprimir[$i]['referente'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(30, 8, $arr_imprimir[$i]['estado_actual'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(18, 8, $arr_imprimir[$i]['fechacarga'], 1, 'C', 0, 0, '', '', true);
                $this->MultiCell(20, 8, "", 1, '', 0, 1, '', '', true);

                $this->MultiCell(80, 9, "", 0, '', 0, 0, '', '', true);

                $this->MultiCell(195, 9, "COMPONENTE " . $arr_imprimir[$i]['componente'][0] . ": " . $arr_imprimir[$i]['detalle_componente'], 1, '', 0, 1, '', '', true);
            }
        }
    }

    // ---------------------------------------- 
    public function printReport_EnvioA_UE($arr_imprimir) {

        if (count($arr_imprimir) > 0) {

            $this->SetFont('helvetica', 'B', 10);
            $this->MultiCell(180, 6, "BUENAS PRÁCTICAS SOCIALES", 0, '', 0, 1, '', '', true);
            $this->Ln(1);
            $this->Ln(1);

            $this->MultiCell(180, 6, "Expedientes remitidos a Unidad Evaluadora", 0, '', 0, 1, '', '', true);
            $this->Ln(1.5);

            $this->SetFont('helvetica', '', 9);

            $this->MultiCell(15, 6, "Nro Acto", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(25, 6, "Expediente", 1, '', 0, 0, '', '', true);
            $this->MultiCell(85, 6, "Institución", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(40, 6, "Localidad", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 6, "Departamento", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 6, "Estado", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(25, 6, "Fecha ingreso", 1, 'C', 0, 1, '', '', true);

            $this->SetFont('helvetica', '', 8);
            for ($i = 0; $i < count($arr_imprimir); $i++) {
                $this->MultiCell(15, 18, $arr_imprimir[$i]['nroacto'], 1, 'R', 0, 0, '', '', true);
                $this->MultiCell(25, 18, $arr_imprimir[$i]['nroexpediente'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(85, 18, $arr_imprimir[$i]['institucion'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(40, 9, $arr_imprimir[$i]['localidad'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 9, $arr_imprimir[$i]['departamento'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 9, $arr_imprimir[$i]['estado_actual'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(25, 9, $arr_imprimir[$i]['fechacarga'], 1, 'C', 0, 1, '', '', true);
                $this->MultiCell(125, 9, "", 0, '', 0, 0, '', '', true);

                $this->MultiCell(135, 9, "COMPONENTE " . $arr_imprimir[$i]['componente'][0] . ": " . $arr_imprimir[$i]['detalle_componente'], 1, '', 0, 1, '', '', true);
            }
        }
    }

    // ---------------------------------------- 

    public function printReport_EnvioDesdeUE($arr_imprimir) {

        if (count($arr_imprimir) > 0) {

            $this->SetFont('helvetica', 'B', 10);
            $this->MultiCell(180, 6, "BUENAS PRÁCTICAS SOCIALES", 0, '', 0, 1, '', '', true);
            $this->Ln(1);
            $this->Ln(1);

            $this->MultiCell(180, 6, "Expedientes remitidos desde Unidad de Informe Social", 0, '', 0, 1, '', '', true);
            $this->Ln(1.5);

            $this->SetFont('helvetica', '', 10);
            $this->MultiCell(18, 6, "Nro Acto", 1, 'J', 0, 0, '', '', true);

            $this->MultiCell(25, 6, "Expediente", 1, '', 0, 0, '', '', true);
            $this->MultiCell(70, 6, "Institución", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(40, 6, "Localidad", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 6, "Departamento", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 6, "Estado", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(32, 6, "Fecha ingreso", 1, 'C', 0, 1, '', '', true);

            $this->SetFont('helvetica', '', 8);
            for ($i = 0; $i < count($arr_imprimir); $i++) {
                $this->MultiCell(18, 18, $arr_imprimir[$i]['nroacto'], 1, 'J', 0, 0, '', '', true);
                $this->MultiCell(25, 18, $arr_imprimir[$i]['nroexpediente'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(70, 18, $arr_imprimir[$i]['institucion'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(40, 9, $arr_imprimir[$i]['localidad'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 9, $arr_imprimir[$i]['departamento'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 9, $arr_imprimir[$i]['estado_actual'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(32, 9, $arr_imprimir[$i]['fechacarga'], 1, 'C', 0, 1, '', '', true);
                $this->MultiCell(113, 9, "", 0, '', 0, 0, '', '', true);

                $this->MultiCell(142, 9, "COMPONENTE " . $arr_imprimir[$i]['componente'][0] . ": " . $arr_imprimir[$i]['detalle_componente'], 1, '', 0, 1, '', '', true);
            }
        }
    }

    // ---------------------------------------- 
    public function printReport_SeguimientoActo($arr_imprimir) {

        if (count($arr_imprimir) > 0) {

            $this->SetFont('helvetica', 'B', 10);
            $this->MultiCell(180, 6, "BUENAS PRÁCTICAS SOCIALES", 0, '', 0, 1, '', '', true);
            $this->Ln(1);
            $this->Ln(1);

            $this->MultiCell(180, 6, "SEGUIMIENTO ACTOS ADMINISTRATIVOS", 0, '', 0, 1, '', '', true);
            $this->Ln(1.5);

            $this->SetFont('helvetica', '', 8);
            $this->MultiCell(18, 8, "Fecha Ingreso", 1, 'C', 0, 0, '', '', true, '', 'B');
            $this->MultiCell(20, 8, "Area Ingreso", 1, 'C', 0, 0, '', '', true, '', 'B');
            $this->MultiCell(10, 8, "Nro Acto", 1, 'C', 0, 0, '', '', true, '', 'B');
            $this->MultiCell(25, 8, "Nro Expediente", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(70, 8, "Institución", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(25, 8, "Localidad", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(25, 8, "Departamento", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(35, 8, "Estado", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(30, 8, "Ubicación actual", 1, 'C', 0, 0, '', '', true);
            $this->MultiCell(18, 8, "Fecha mov", 1, 'C', 0, 1, '', '', true);
            //$this->MultiCell(17, 8, "$ Solicitado", 1, 'C', 0, 0, '', '', true);
            //$this->MultiCell(30, 8, "Componente", 1, 'C', 0, 0, '', '', true);
            //$this->MultiCell(40, 8, "Referente", 1, 'C', 0, 0, '', '', true);


            $this->SetFont('helvetica', '', 8);
            for ($i = 0; $i < count($arr_imprimir); $i++) {
                
                $this->MultiCell(18, 10, $arr_imprimir[$i]['fechacarga'], 1, 'C', 0, 0, '', '', true);
                $this->MultiCell(20, 10, $arr_imprimir[$i]['area_carga'], 1, 'C', 0, 0, '', '', true);
                $this->MultiCell(10, 10, $arr_imprimir[$i]['nroacto'], 1, 'R', 0, 0, '', '', true);
                $this->MultiCell(25, 10, $arr_imprimir[$i]['nroexpediente'], 1, 'R', 0, 0, '', '', true);
                $this->MultiCell(70, 10, $arr_imprimir[$i]['institucion'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(25, 10, $arr_imprimir[$i]['localidad'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(25, 10, $arr_imprimir[$i]['departamento'], 1, '', 0, 0, '', '', true);
                //$this->MultiCell(17, 8, $arr_imprimir[$i]['montosolicitado'], 1, '', 0, 0, '', '', true);
                //$this->MultiCell(40, 8, $arr_imprimir[$i]['referente'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(35, 10, $arr_imprimir[$i]['estado_actual'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(30, 10, $arr_imprimir[$i]['ubicacion_actual'], 1, '', 0, 0, '', '', true);
                $this->MultiCell(18, 10, $arr_imprimir[$i]['fecha_ubi'], 1, '', 0, 1, '', '', true);

                //  $this->MultiCell(20, 8, "", 1, '', 0, 1, '', '', true);
                //  $this->MultiCell(80, 9, "", 0, '', 0, 0, '', '', true);
                // $this->MultiCell(195, 9, "COMPONENTE " . $arr_imprimir[$i]['componente'][0] . ": " . $arr_imprimir[$i]['detalle_componente'], 1, '', 0, 1, '', '', true);
            }
        }
    }

    // ---------------------------------------- 
}
