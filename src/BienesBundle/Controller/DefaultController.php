<?php

namespace BienesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\HttpFoundation\Request;
use BienesBundle\Entity\Bien;

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

    public function pdfAltaAction(Request $request,int $id){
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository('BienesBundle:Bien')->find($id);
        $codigo = $bien->getCodigo();

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //$pdf = $this->get("white_october.tcpdf")->create();
        $pdf->AddPage();
        $pdf->Write(0,$id.' '.$request->get('color'));

        $pdf->Output('prestamo.pdf', 'I');

    }

    public function pruebaPDFAction(Request $request,int $id) {
        
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository('BienesBundle:Bien')->find($id);
        $codigo = $bien->getCodigo();

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
      
      //$pdf->Image('imagenes/logo ministerio-negro_sin fondo.png');
     // $pdf->Image('imagenes/logo ministerio-negro_sin fondo.png', 30, 140, 120, 15, 'PNG','' , '', true, 150, '', false, false, 0, false, false, false);
      

      $pdf->Output('prestamo.pdf', 'I');


    }

}

class MYPDF extends \TCPDF {

    //Page header
    public function Header() {
        // Logo
       // $image_file = 'imagenes/logo ministerio-negro_sin fondo.png';
       // $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        //$image_file = 'imagenes/logo ministerio-negro_sin fondo.png';
        $this->Image('imagenes/logo ministerio-negro_sin fondo.png');
        // Page number
        $this->Cell(0, 10, 'Sectorial de Informática
        Ministerio de Igualdad, Género y Diversidad
        Corrientes 2879 - (3000) Santa Fe
        Tel: (0342) 4572888 / 4589468', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
    }
}

/*class MyReporte extends \TCPDF {
    public function __construct() {
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Nicola Asuni');

    }
}*/