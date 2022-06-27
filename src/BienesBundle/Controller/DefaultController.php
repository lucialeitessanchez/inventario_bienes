<?php

namespace BienesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\HttpFoundation\Request;
use BienesBundle\Entity\Bien;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use BienesBundle\Reporte\BienPDF;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Bienes/Default/index.html.twig');
    }

    public function loginsdb(){
        # Las claves de acceso, ahorita las ponemos aquí
        # y en otro ejercicio las ponemos en una base de datos
        $usuario_correcto = "lls";
        $palabra_secreta_correcta = "123456";
        /*
        Para leer los datos que fueron enviados al formulario,
        accedemos al arreglo superglobal llamado $_POST en PHP, y
        para obtener un valor accedemos a $_POST["clave"] en donde
        clave es el "name" que le dimos al input
         */
# Nota: no estamos haciendo validaciones
        $usuario = $_POST["usuario"];
        $palabra_secreta = $_POST["palabra_secreta"];
# Luego de haber obtenido los valores, ya podemos comprobar:
        if ($usuario === $usuario_correcto && $palabra_secreta === $palabra_secreta_correcta) {
            # Significa que coinciden, así que vamos a guardar algo
            # en el arreglo superglobal $_SESSION, ya que ese arreglo
            # "persiste" a través de todas las páginas
            # Iniciar sesión para poder usar el arreglo
            session_start();
            # Y guardar un valor que nos pueda decir si el usuario
            # ya ha iniciado sesión o no. En este caso es el nombre
            # de usuario
            $_SESSION["usuario"] = $usuario;
            # Luego redireccionamos a la página "Secreta"
            header("Location: secreta.php");
        } else {
            # No coinciden, así que simplemente imprimimos un
            # mensaje diciendo que es incorrecto
            echo "El usuario o la contraseña son incorrectos";
        }


    }

    public function pdfAltaAction(Request $request,int $id) {
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository('BienesBundle:Bien')->find($id);
        $responsable= $bien->getResponsable();
        $factura = $bien->getFactura();
        $codigo = $bien->getCodigo();
        $fecha = '';

        if ($factura)
            $fecha=date_format($factura->getFecha(), 'd/m/Y'); //transformo la fecha con ese formato porque no esta en string

        $pdf = new BienPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //$pdf = $this->get("white_october.tcpdf")->create();
        $pdf->AddPage();
        $pdf->SetMargins(25, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        //documento en si
        $html = '<div align="center"><h1>CARGO DE BIENES DE CAPITAL</h1></div>' ;
        $pdf->writeHTML($html, true, false, true, false, '');

        $txt="\n\n\nResponsable de la tenencia, guarda y conservación";
        $txt2="\nOficina: ".$responsable->getCargo();
        $txt3="\nAgente: ".$responsable->getNombre();
        $txt31="\nUbicación: ".$bien->getUbicacion();
        $txt4="\n\nDatos de adquisición";
        $txt5="\nFecha adquisición: ".$fecha;
        $txt5b="\nTipo de adquisición: ".$factura->getTipoAdquisicion();
        $txt6="\nProveedor: ".$bien->getProveedor();
        if ($factura) {
            $txt7="\nNº de Factura: ".$factura->getNumeroFactura();
            $txt9="\nImporte unitario: $".$factura->getMontoUnitario();
            $txt10="\nImporte total: $".$factura->getMontoTotal();
        } else {
            $txt7 = '';
            $txt9 = '';
            $txt10="\nFactura: Sin Datos de Factura.";
        }

        $txt11="\n\nBien adquirido";
        $txt12="\nDetalle: ".$bien->getEstado();
        $txt13="\nDescripcion/SARI/N° de Serie: ".$bien->getDescripcion();
        $txt14="\nColor: ".$request->get('color');
        $txt15="\nNº codigo de sistema: ".$codigo;
        $txt16="\nCaracteristica: ".$bien->getTipo()." ".$bien->getRama();

        //cuerpo del texto
        $pdf->Write(0, $txt.$txt2.$txt3.$txt31.$txt4.$txt5.$txt5b.$txt6.$txt7.$txt9.$txt10.$txt11.$txt12.$txt13.$txt14.$txt15.$txt16, '', 0, '', true, 0, false, false, 0);

        //firmas
        if($responsable->getFuncionario()){ //si es funcionario solo aparece el mismo, no necesita autorizacion
        $txtF="\n\n\n ............................................ \n Firma Responsable - ".$responsable->getNombre();
        $pdf->Write(0,$txtF,'',0,'',true, 0,false,false,0);
        }
        else{
            $txtR="\n\n\n\n ............................................ \n Firma Responsable - ".$responsable->getNombre(); 
            $txtF="\n\n\n\n\n ............................................ \n Firma Responsable del Sector- ".$responsable->getResponsableArea();
            $pdf->Write(0,$txtR.$txtF,'',0,'',true, 0,false,false,0);
        }
        $txtC="\n\n\n\n ............................................ \n Firma Responsable de compras";
        $pdf->Write(0, $txtC, '', 0, 'C', true, 0, false, false, 0);
        
        
        /**
         * Genero el path del archivo con un nombre temporal
         */
        $filename = $id.'alta.pdf';
        $cache_dir = $this->getParameter('kernel.cache_dir');
        //$file = $cache_dir. DIRECTORY_SEPARATOR .$filename;
        $file = tempnam($cache_dir,'reporte_bien');

        /**
         * Guardo el pdf en un archivo local
         */
        $pdf->Output($file, 'F');

        /**
         * genero una respuesta para la descarga del archivo
         */
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function pruebaPDFAction(Request $request,int $id) {
        
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository('BienesBundle:Bien')->find($id);
        $codigo = $bien->getCodigo();

        $pdf = new BienPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //$pdf = $this->get("white_october.tcpdf")->create();
        $pdf->AddPage();

        if ($request->query->has('saludo')) {
            $pdf->Write(0, 'Parametro Saludo: '.$request->get('saludo'), '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, print_r($request->query->all(),1), '', 0, 'L', true, 0, false, false, 0);
        }

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        
        $html1 ='<div align="center"> <img src="imagenes/logo ministerio-negro_sin fondo.png" alt="Elva dressed as a fairy" id="banner"> </div>';
        $pdf->writeHTML($html1, true, false, true, false, '');
        //textos
        $html = '<div align="center"><h1>PRÉSTAMO DE PATRIMONIO INFORMÁTICO</h1></div>' ;
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $txt2 = "Por medio de la presente, la Sectorial de Informática del Ministerio de Igualdad, Género y Diversidad de la Provincia de Santa Fe, deja constancia de que el/la ";
        $txt3=$bien->getTipo()." ".$bien->getRama();
        $txt4=" número de código sistema: ".$codigo;
        $txt5=" y SARI/serie: ".$bien->getDescripcion();
        $txt6=" es cedido, y pasa a ser responsable de la tenencia, guarda y conservación del mismo al agente ".$bien->getResponsable();
        $txt7=", a partir del día ".date("d/m/Y").".\n";

        $pdf->Write(3,' ', '', 0, 'R', true, 0, false, false, 0);
      
        
      
      $pdf->Write(3, ' ', '', 0, 'R', true, 0, false, false, 0); 
      $pdf->Write(3, ' ', '', 0, 'R', true, 0, false, false, 0);
      $pdf->Write(3, ' ', '', 0, 'R', true, 0, false, false, 0); 
      $pdf->Write(0, $txt2.$txt3.$txt4.$txt5.$txt6.$txt7, '', 0, 'J', true, 0, false, false, 0);
      $txtF="\n\n\n\n\n .......................................................... \n Firma Responsable - ".$bien->getResponsable();
        $pdf->Write(0,$txtF,'',0,'C',true, 0,false,false,0);
      
      //$pdf->Image('imagenes/logo ministerio-negro_sin fondo.png');
     // $pdf->Image('imagenes/logo ministerio-negro_sin fondo.png', 30, 140, 120, 15, 'PNG','' , '', true, 150, '', false, false, 0, false, false, false);
      

      $pdf->Output('prestamo.pdf', 'I');


    }

    public function pdfBajaAction(int $id) {
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository('BienesBundle:Bien')->find($id);
        $responsable= $bien->getResponsable();
        $factura = $bien->getFactura();
        $codigo = $bien->getCodigo();
        $fechaBaja=date_format($bien->getFechabaja(), 'd/m/Y'); 

        if ($factura)
            $fecha=date_format($factura->getFecha(), 'd/m/Y'); //transformo la fecha con ese formato porque no esta en string

        $pdf = new BienPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //$pdf = $this->get("white_october.tcpdf")->create();
        $pdf->AddPage();
        $pdf->SetMargins(25, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        //documento en si
        $html = '<div align="center"><h1>BAJA DE BIENES DE CAPITAL</h1></div>' ;
        $pdf->writeHTML($html, true, false, true, false, '');

        $txt="\n\n\nResponsable de la tenencia, guarda y conservación";
        $txt2="\nOficina: ".$responsable->getCargo();
        $txt3="\nAgente: ".$responsable->getNombre();
        $txt4="\n\nDatos de adquisición";
        $txt5="\nFecha adquisición: ".$fecha;
        $txt6="\nProveedor ".$bien->getProveedor();
        if ($factura) {
            $txt7="\nNº de Factura: ".$factura->getNumeroFactura();
            $txt9="\nImporte unitario: $".$factura->getMontoUnitario();
            $txt10="\nImporte total: $".$factura->getMontoTotal();
        } else {
            $txt7 = '';
            $txt9 = '';
            $txt10="\nFactura: Sin Datos de Factura.";
        }

        $txt11="\n\nBien adquirido";
        $txt12="\nDetalle: ".$bien->getEstado();
        $txt12b="\nMotivo de la baja: ".$bien->getMotivobaja();
        $txt13="\nDescripcion/SARI/N° de Serie: ".$bien->getDescripcion();
        $txt14="\nFecha de baja: ".$fechaBaja;
        $txt15="\nNº codigo de sistema: ".$codigo;
        $txt16="\nCaracteristica: ".$bien->getTipo()." ".$bien->getRama();

        //cuerpo del texto
        $pdf->Write(0, $txt.$txt2.$txt3.$txt4.$txt5.$txt6.$txt7.$txt9.$txt10.$txt11.$txt12.$txt12b.$txt13.$txt14.$txt15.$txt16, '', 0, '', true, 0, false, false, 0);

        //firmas
        if($responsable->getFuncionario()){ //si es funcionario solo aparece el mismo, no necesita autorizacion
        $txtF="\n\n\n ............................................ \n Firma Responsable - ".$responsable->getNombre();
        $pdf->Write(0,$txtF,'',0,'',true, 0,false,false,0);
        }
        else{
            $txtR="\n\n\n\n ............................................ \n Firma Responsable - ".$responsable->getNombre(); 
            $txtF="\n\n\n\n\n ............................................ \n Firma Responsable del Sector- ".$responsable->getResponsableArea();
            $pdf->Write(0,$txtR.$txtF,'',0,'',true, 0,false,false,0);
        }
        $txtC="\n\n\n\n ............................................ \n Firma Responsable de compras";
        $pdf->Write(0, $txtC, '', 0, 'C', true, 0, false, false, 0);
        
        
        /**
         * Genero el path del archivo con un nombre temporal
         */
        $filename = $id.'alta.pdf';
        $cache_dir = $this->getParameter('kernel.cache_dir');
        //$file = $cache_dir. DIRECTORY_SEPARATOR .$filename;
        $file = tempnam($cache_dir,'reporte_bien');

        /**
         * Guardo el pdf en un archivo local
         */
        $pdf->Output($file, 'F');

        /**
         * genero una respuesta para la descarga del archivo
         */
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        $response->deleteFileAfterSend(true);

        return $response;
    }

}
