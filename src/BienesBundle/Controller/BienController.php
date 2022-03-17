<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Factura;
use BienesBundle\Entity\Bien;
use BienesBundle\Entity\Proveedor;
use BienesBundle\Entity\Rama;
use BienesBundle\Entity\Responsable;
use BienesBundle\Entity\ResponsableArea;
use BienesBundle\Entity\Tipo;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Symfony\Component\Validator\Constraints as Assert;

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
        
        // Matriz de retorno con estructura de los barrios de la identificación de ciudad proporcionada
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
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
    public function newAction(Request $request)
    {
        $bien = new Bien();
        $form = $this->createForm('BienesBundle\Form\BienType', $bien);
        $form->handleRequest($request);
        $bien->setCodigo(0);
        $bien->setUsuario($this->get_ip()." ".$this->convertirUsuarioIP($this->get_ip())); //guarda el usuario que cargo la ip y el nombre si lo tiene guardado
        
       // $userProvider = new UserProvider();

        // Obtengo la direccion ip del cliente
        $clientIp = $request->getClientIp();
        // Obtengo el usuario logueado
        $user = $this->getUser();
        $usuario_ip = sprintf('%s@%s',$user->getUsername(),$clientIp);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $bien->setCodigo(0);

            //le pido a la base de datos los objetos tipo
            $repository = $this->getDoctrine()->getRepository(Tipo::class);//le pido a la base de datos los objetos tipo
            $tipe=($repository->find($bien->getTipo()));//esto no se que me devuelve
            $tipo=intval($tipe->getId());//me devuelve el objeto que coincide con el nombre de la rama que es el que obtengo en el toString de tipo

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

   
    public function returnPDFResponseFromHTMLAction($filtro, $campo){
      
        // set_time_limit (30); descomenta esta línea según tus necesidades
        // Si no estás en un controlador, recupere de alguna manera el contenedor de servicios y luego recupérelo
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // si estás en un controlador, usa:
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Our Code World');
        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'ourcodeworld_pdf_demo';
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

    

    
}