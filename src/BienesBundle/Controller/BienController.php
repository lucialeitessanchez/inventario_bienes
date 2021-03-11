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
use Symfony\Component\HttpFoundation\Request;

/**
 * Bien controller.
 *
 */
class BienController extends Controller
{

    /**
     * Lists all bien entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $biens = $em->getRepository('BienesBundle:Bien')->findAll();

        return $this->render('bien/index.html.twig', array(
            'biens' => $biens,
        ));
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


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


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
       $repository3 = $this->getDoctrine()->getRepository(Factura::class);
       $factura = $repository3->find(($bien->getFactura()));

        $fechaActual = date('d-m-Y H:i:s');

        //$factura = $factura->getProveedor() == $proveedor;

        return $this->render('factura/imprir.html.twig', array(
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

}
