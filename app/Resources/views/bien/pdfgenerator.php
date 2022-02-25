<?php


function returnPDFResponseFromHTML($html){
         // set_time_limit (30); descomenta esta línea según tus necesidades
         // Si no estás en un controlador, recupere de alguna manera el contenedor de servicios y luego recupérelo
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // si estás en un controlador, usa:
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Listado Bienes');
        $pdf->SetTitle(('Listado Bienes'));
        $pdf->SetSubject('Listado Bienes');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();
        
        $filename = 'Listado_Bienes';
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // Esto generará el PDF como respuesta directamente
}
