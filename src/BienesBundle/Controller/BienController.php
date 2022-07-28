<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Factura;
use BienesBundle\Entity\Bien;
use BienesBundle\Entity\Proveedor;
use BienesBundle\Entity\Rama;
use BienesBundle\Entity\Responsable;
use BienesBundle\Entity\ResponsableArea;
use BienesBundle\Entity\Tipo;
use BienesBundle\Entity\User;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Symfony\Component\Validator\Constraints as Assert;
use BienesBundle\Reporte\BienPDF;
use Symfony\Component\Security\Core\User\UserInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Bien controller.
 *
 */
class BienController extends Controller
{

     /**
     * Devuelve una cadena JSON con las ramas de los tipos con la identificación proporcionada.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function listRamasOfTipoAction(Request $request)
    {
        // Obtener administrador de entidades y repositorio
        $em = $this->getDoctrine()->getManager();
        $ramasRepository = $em->getRepository("BienesBundle:Rama");
        
        // Busque las ramas que pertenecen al tipo con el ID dado como parámetro GET "tipoid"
        $ramas = $ramasRepository->createQueryBuilder("q")
            ->where("q.tipo = :tipoid")
            ->setParameter("tipoid", $request->query->get("tipoid"))
            ->getQuery()
            ->getResult();
        
        // Serializar en una matriz los datos que necesitamos, en este caso solo el nombre y la identificación
        // Nota: también puede usar un serializador, para fines explicativos, lo haremos manualmente
        $responseArray = array();
        foreach($ramas as $rama){
            $responseArray[] = array(
                "id" => $rama->getId(),
                "name" => $rama->getNombreRama()
            );
        }
        
        // Matriz de retorno con estructura de las ramas de la identificación de tipo proporcionada
        return new JsonResponse($responseArray);

       
    }


    //funcion de filtro para proveedor-factura

    /**
     * Devuelve una cadena JSON con las ramas de los tipos con la identificación proporcionada.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function listFacturasOfProveedorAction(Request $request)
    {
        // Obtener administrador de entidades y repositorio
        $em = $this->getDoctrine()->getManager();
        $facturasRepository = $em->getRepository("BienesBundle:Factura");
        $facturasProveedor = $em->getRepository("BienesBundle:Proveedor"); //tengo todos los objetos proveedor
        
        // Busque las facturas que pertenecen al proveedor con el ID dado como parámetro GET "proveedorid"
        $facturas = $facturasRepository->createQueryBuilder("q")
            ->where("q.proveedor = :proveedorid ")
            ->setParameter("proveedorid", $request->query->get("proveedorid"))
            ->getQuery()
            ->getResult();
      
        // Serializar en una matriz los datos que necesitamos, en este caso solo el nombre y la identificación
        // Nota: también puede usar un serializador, para fines explicativos, lo haremos manualmente
        $responseArray = array();
        foreach($facturas as $factura){
           $proveedor=$facturasProveedor->find($factura->getProveedor()); //buscos dentro de los objetos proveedor el que me coincide con el proveedor que tiene la factura

            $responseArray[] = array(
                "esOrganismoPublico" => $proveedor->getOrganismoPublico(), 
                "id" => $factura->getId(),
                "name" => $factura->getNumeroFactura(),
                
            );
        }
        
        // Matriz de retorno con estructura de las facturas de la identificación de proveedor proporcionada
        return new JsonResponse($responseArray);

       
    }

    /**
     * Lists all bien entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $biens = $em->getRepository('BienesBundle:Bien')->findAll();
        $responsables = $em->getRepository('BienesBundle:Responsable')->findAll();
       // $responsables = $em->getRepository('BienesBundle:Responsable')->find($biens->getResponsable());

        return $this->render('bien/index.html.twig', array(
            'biens' => $biens,
            'responsables' => $responsables
        ));
    }

    //Obtiene la IP del cliente
    function get_ip() {

        $localIP = getHostByName(php_uname('n'));
        return $localIP;

    }
    // la transforma en el nombre del usuario
    function convertirUsuarioIP($ipaddress){
        $ipaddress=strval($ipaddress);
        $ip_nombre = array("Carolina Tarre","Alejandra Robledo","Magali Rodriguez","Lucia Leites","Leonardo Lentini","Andres DeLamata","Recepcion","Tania Alvarez",
            "Agustin","Sandra Lopez","Miriam Urgorri","Florencia Marinaro","Celia Arena","Lucas Maurice","Marisol Gutierrez","Gabriel Palud","Mariela Zen","Nancy Ortiz","Luciano  Borgogno",
            "Daniela Leopold","Melisa Trabuchi");
        $ip_fija = array("10.3.17.23","10.3.17.31","10.3.17.33","10.3.17.17","10.3.17.10","10.3.17.32","10.3.17.81","10.3.17.84",
            "10.3.17.203","10.3.17.45","10.3.17.82","10.3.17.86","10.3.17.88","10.3.17.44","10.3.17.87","10.3.17.55","10.3.17.56","10.3.17.48","10.3.17.25","10.3.17..50",
            "10.3.17.53","10.3.17.52");
        $nombre = str_replace($ip_fija,$ip_nombre,$ipaddress);
        return $nombre;
    }

    /**
     * Creates a new bien entity.
     *
     */
      /**
    * @IsGranted("ROLE_ALTA")
    */
    public function newAction(Request $request)
    {
        $bien = new Bien();
        $form = $this->createForm('BienesBundle\Form\BienType', $bien);
        $form->handleRequest($request);
        $bien->setCodigo(0);
        
       
        $user=$this->getUser();
        $usuario = $repository = $this->getDoctrine()->getRepository(User::class)->find($user->getId());

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $bien->setCodigo(0);

            //le pido a la base de datos los objetos tipo
            $repository = $this->getDoctrine()->getRepository(Tipo::class);//le pido a la base de datos los objetos tipo
            $tipe=($repository->find($bien->getTipo()));//esto no se que me devuelve
            $tipo=intval($tipe->getId());//me devuelve el objeto que coincide con el nombre de la rama que es el que obtengo en el toString de tipo

           // $repository = $this->getDoctrine()->getRepository(User::class);
           // $usuario=$repository->findBy();
           // $bien->setUsuario($user);
            $bien->setUsuario($usuario);
        //    if($tipe->getIdClasificacion() == "BI" && $user->getRoles() == 'ROLE_ADMIN'){
            $em->persist($bien);
            $em->flush();
          //  }

            //le pido a la base de datos los objetos rama
            $repository2 = $this->getDoctrine()->getRepository(Rama::class);
            $rame=($repository2->find($bien->getRama())); //me devuelve el objeto que coincide con el nombre de la rama que es el que obtengo en el toString de rama


            $rama=intval($rame->getId());// transformo el id de la rama en un entero


           $bienId=intval($bien->getId());

            $codigo = ($tipo."-".$rama."-".$bienId);
            $bien->setCodigo($codigo);

            $bienId=intval($bien->getId());

            $codigo = ($tipo."-".$rama."-".$bienId);
            $bien->setCodigo($codigo);

            //aca iria lo del usuario

            //por las dudas para actualizar el id de bien
            $em->persist($bien);
            $em->flush();


            return $this->redirectToRoute('bien_show', array('id' => $bien->getId()));
        }


        return $this->render('bien/new.html.twig', array(
            'bien' => $bien,

            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bien entity.
     *
     */
    public function showAction(Bien $bien)
    {
        $deleteForm = $this->createDeleteForm($bien);
        $em = $this->getDoctrine()->getManager(); // de aca para abajo hago todo para que se actualice el codigo

       

        //le pido a la base de datos los objetos tipo
        $repository = $this->getDoctrine()->getRepository(Tipo::class);//le pido a la base de datos los objetos tipo
        $tipe=($repository->find($bien->getTipo()));//esto no se que me devuelve
        $tipo=intval($tipe->getId());//entonces no se que guardo aca


        //le pido a la base de datos los objetos rama
        $repository2 = $this->getDoctrine()->getRepository(Rama::class);
        $rame=($repository2->find($bien->getRama())); //esto no se que me devuelve


        $rama=intval($rame->getId());//entonces no se que guardo aca
        //busco por el nombre que tengo guardado en bien contra las ramas en la base de datos

        $bienId=intval($bien->getId());

        $codigo = ($tipo."-".$rama."-".$bienId);
        $bien->setCodigo($codigo);

        $bienId=intval($bien->getId());

        $codigo = ($tipo."-".$rama."-".$bienId);
        $bien->setCodigo($codigo);

       
        $em->persist($bien);
        $em->flush();


        return $this->render('bien/show.html.twig', array(
            'bien' => $bien,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bien entity.
     *
     */
    /**
    * @IsGranted("ROLE_JERARQUICO")
    */
    public function editAction(Request $request, Bien $bien)
    {
        $deleteForm = $this->createDeleteForm($bien);
        $editForm = $this->createForm('BienesBundle\Form\BienType', $bien);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bien_edit', array('id' => $bien->getId()));
        }

        return $this->render('bien/edit.html.twig', array(
            'bien' => $bien,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bien entity.
     *
     */
    /**
    * @IsGranted("ROLE_ADMIN")
    */
    public function deleteAction(Request $request, Bien $bien)
    {
        $form = $this->createDeleteForm($bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bien);
            $em->flush();
        }

        return $this->redirectToRoute('bien_index');
    }

    /**
     * Creates a form to delete a bien entity.
     *
     * @param Bien $bien The bien entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bien $bien)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bien_delete', array('id' => $bien->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function imprimirAction(Bien $bien){
        $deleteForm = $this->createDeleteForm($bien);

        //le pido a la base de datos los objetos proveedor
        $repository = $this->getDoctrine()->getRepository(Proveedor::class);
        $proveedor = $repository->find(($bien->getProveedor()));

        //le pido a la base de datos los objetos responsable
        $repository2 = $this->getDoctrine()->getRepository(Responsable::class);
        $responsable = $repository2->find(($bien->getResponsable())); //guardo el responsable que me coincide con el que esta en la base de datos

        $repository4 = $this->getDoctrine()->getRepository(ResponsableArea::class);
        $responsableA= $repository4->find($responsable->getResponsableArea()); //ya guarde en el paso anterior el responsable, ahora lo hago coincidir con el de area porque necesito el cargo

        //le pido a la base de datos los objetos factura
        $factura = $bien->getFactura();
        /*if ($bien->getFactura()) {
            $repository3 = $this->getDoctrine()->getRepository(Factura::class);
            $factura = $repository3->find(($bien->getFactura()));
        }*/
        
        $fechaActual = date('d-m-Y H:i:s');


        //$factura = $factura->getProveedor() == $proveedor;

        return $this->render('bien/Altaimprimir.html.twig', array(
                'bien' => $bien,
                'proveedor'=>$proveedor,
                'factura'=>$factura,
                'responsable'=>$responsable,
                'responsableA'=>$responsableA,
                'fecha'=>$fechaActual,
                'delete_form' => $deleteForm->createView()
            )

        );
    }

    public function prestamoAction(Bien $bien){
        $deleteForm = $this->createDeleteForm($bien);

        //le pido a la base de datos los objetos proveedor
        $repository = $this->getDoctrine()->getRepository(Proveedor::class);
        $proveedor = $repository->find(($bien->getProveedor()));

        //le pido a la base de datos los objetos responsable
        $repository2 = $this->getDoctrine()->getRepository(Responsable::class);
        $responsable = $repository2->find(($bien->getResponsable())); //guardo el responsable que me coincide con el que esta en la base de datos

        $repository4 = $this->getDoctrine()->getRepository(ResponsableArea::class);
        $responsableA= $repository4->find($responsable->getResponsableArea()); //ya guarde en el paso anterior el responsable, ahora lo hago coincidir con el de area porque necesito el cargo

        //le pido a la base de datos los objetos factura
        $factura = $bien->getFactura();
        /*if ($bien->getFactura()) {
            $repository3 = $this->getDoctrine()->getRepository(Factura::class);
            $factura = $repository3->find(($bien->getFactura()));
        }*/

        $fechaActual = date('d-m-Y H:i:s');


        //$factura = $factura->getProveedor() == $proveedor;

        return $this->render('bien/imprimir.html.twig', array(
                'bien' => $bien,
                'proveedor'=>$proveedor,
                'factura'=>$factura,
                'responsable'=>$responsable,
                'responsableA'=>$responsableA,
                'fecha'=>$fechaActual,
                'delete_form' => $deleteForm->createView()
            )

        );


    }
    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     *
     * @param Request $request
     * @return JsonResponse
     */

    //PDF DE IMPRESIONES TOTALES
    public function returnPDFResponseFromHTMLAction($filtro, $campo){
      
        // set_time_limit (30); descomenta esta línea según tus necesidades
        // Si no estás en un controlador, recupere de alguna manera el contenedor de servicios y luego recupérelo
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // si estás en un controlador, usa:
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Bienes');
        $pdf->SetTitle(('Listado de bienes'));
        $pdf->SetSubject('');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'bienes'.$filtro;
        $em = $this->getDoctrine()->getManager();
        $biens = $em->getRepository('BienesBundle:Bien')->findAll();
        

        if($filtro != "*"  ){
            $matcher = "/{$filtro}/i";
             $newBiens = [];
            foreach($biens as $bien){
                if(preg_match($matcher, $bien->$campo()) == 1){
                    array_push($newBiens, $bien);
                }
             }      
        
        
            $htmlTable = $this->render('/bien/tableBlockBien.twig', ["biens" => $newBiens, "pdfp" => true])->getContent();
        
        }else{
            $htmlTable = $this->render('/bien/tableBlockBien.twig', ["biens" => $biens, "pdfp" => true])->getContent();

        }
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $htmlTable, $border = 1, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->Output($filename.".pdf",'I'); // Esto generará el PDF como respuesta directamente

       
         
        $filename = 'alta.pdf';
        $cache_dir = $this->getParameter('kernel.cache_dir');
        //$file = $cache_dir. DIRECTORY_SEPARATOR .$filename;
        $file = tempnam($cache_dir,'reporte_bien');

        // Guardo el pdf en un archivo local

        $pdf->Output($file, 'F');

        // genero una respuesta para la descarga del archivo
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        $response->deleteFileAfterSend(true);

        return $response;
       
    }


    public function pdfBaja(Request $request,int $id) {
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
       
        $txt6="\nProveedor: ".$bien->getProveedor();
        if ($factura) {
            $txt5="\nFecha adquisición: ".$fecha;
            $txt5b="\nTipo de adquisición: ".$factura->getTipoAdquisicion();
            $txt7="\nNº de Factura: ".$factura->getNumeroFactura();
            $txt9="\nImporte unitario: $".$factura->getMontoUnitario();
            $txt10="\nImporte total: $".$factura->getMontoTotal();
        } else {
            $txt7 = '';
            $txt9 = '';
            $txt10=" ";
            $txt5="\nFecha adquisicion: No posee por ser organismo público";
            $txt5b="\nEs Organismo público";
        }
        $txt11="\n\nBien adquirido";
        $txt12="\nDetalle: ".$bien->getEstado();
        $txt12b="\nMotivo de la baja: ".$bien->getMotivobaja();
        $txt13="\nDescripcion/SARI/N° de Serie: ".$bien->getDescripcion();
        $txt14="\nFecha de baja: ".$fechaBaja;
        $txt15="\nNº codigo de sistema: ".$codigo;
        $txt16="\nCaracteristica: ".$bien->getTipo()." ".$bien->getRama();

        //cuerpo del texto
        $pdf->Write(0, $txt.$txt2.$txt3.$txt4.$txt5.$txt5b.$txt6.$txt7.$txt9.$txt10.$txt11.$txt12.$txt12b.$txt13.$txt14.$txt15.$txt16, '', 0, '', true, 0, false, false, 0);

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
        $filename = $id.'baja.pdf';
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


    //dar de baja un bien de manera logica
    public function bajaAction(Request $request, Bien $bien)
    {
        $deleteForm = $this->createDeleteForm($bien);
        $editForm = $this->createForm('BienesBundle\Form\BienBajaType', $bien);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $bien->setEstado("Baja");
            $this->getDoctrine()->getManager()->flush();
            $idB=$bien->getId();

            
            return $this->pdfBaja($request,$idB);
           
            //return $this->redirectToRoute('bien_index', array('id' => $bien->getId()));
        }

        return $this->render('bien/baja.html.twig', array(
            'bien' => $bien,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    //seccion consumible
    public function newconsumibleAction(Request $request)
    {
        $bien = new Bien();
        $form = $this->createForm('BienesBundle\Form\BienconsumibleType', $bien);
        $form->handleRequest($request);
        $bien->setCodigo(0);
        //$user=$this->getUser();
       
    

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $bien->setCodigo(0);

            //le pido a la base de datos los objetos tipo
            $repository = $this->getDoctrine()->getRepository(Tipo::class);//le pido a la base de datos los objetos tipo
            $tipe=($repository->find($bien->getTipo()));//esto no se que me devuelve
            $tipo=intval($tipe->getId());//me devuelve el objeto que coincide con el nombre de la rama que es el que obtengo en el toString de tipo

           // $repository = $this->getDoctrine()->getRepository(User::class);
           // $usuario=$repository->findBy();
           // $bien->setUsuario($user);

            $em->persist($bien);
            $em->flush();


            //le pido a la base de datos los objetos rama
            $repository2 = $this->getDoctrine()->getRepository(Rama::class);
            $rame=($repository2->find($bien->getRama())); //me devuelve el objeto que coincide con el nombre de la rama que es el que obtengo en el toString de rama


            $rama=intval($rame->getId());// transformo el id de la rama en un entero


           $bienId=intval($bien->getId());

            $codigo = ($tipo."-".$rama."-".$bienId);
            $bien->setCodigo($codigo);

            $bienId=intval($bien->getId());

            $codigo = ($tipo."-".$rama."-".$bienId);
            $bien->setCodigo($codigo);

            //aca iria lo del usuario

            //por las dudas para actualizar el id de bien
            $em->persist($bien);
            $em->flush();


            return $this->redirectToRoute('bien_index');
        }


        return $this->render('bien/newconsumible.html.twig', array(
            'bien' => $bien,
            'form' => $form->createView(),
        ));
    }
    
}