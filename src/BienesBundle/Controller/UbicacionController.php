<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Ubicacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * Ubicacion controller.
 *
 */
 /**
    * @IsGranted("ROLE_ADMIN")
    */
class UbicacionController extends Controller
{
    /**
     * Lists all ubicacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ubicacions = $em->getRepository('BienesBundle:Ubicacion')->findAll();

        return $this->render('ubicacion/index.html.twig', array(
            'ubicacions' => $ubicacions,
        ));
    }

    /**
     * Creates a new ubicacion entity.
     *
     */
    public function newAction(Request $request)
    {
        $ubicacion = new Ubicacion();
        $form = $this->createForm('BienesBundle\Form\UbicacionType', $ubicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ubicacion);
            $em->flush();

            return $this->redirectToRoute('ubicacion_show', array('id' => $ubicacion->getId()));
        }

        return $this->render('ubicacion/new.html.twig', array(
            'ubicacion' => $ubicacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ubicacion entity.
     *
     */
    public function showAction(Ubicacion $ubicacion)
    {
        $deleteForm = $this->createDeleteForm($ubicacion);

        return $this->render('ubicacion/show.html.twig', array(
            'ubicacion' => $ubicacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ubicacion entity.
     *
     */
    public function editAction(Request $request, Ubicacion $ubicacion)
    {
        $deleteForm = $this->createDeleteForm($ubicacion);
        $editForm = $this->createForm('BienesBundle\Form\UbicacionType', $ubicacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ubicacion_edit', array('id' => $ubicacion->getId()));
        }

        return $this->render('ubicacion/edit.html.twig', array(
            'ubicacion' => $ubicacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ubicacion entity.
     *
     */
    public function deleteAction(Request $request, Ubicacion $ubicacion)
    {
        $form = $this->createDeleteForm($ubicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ubicacion);
            $em->flush();
        }

        return $this->redirectToRoute('ubicacion_index');
    }

    /**
     * Creates a form to delete a ubicacion entity.
     *
     * @param Ubicacion $ubicacion The ubicacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ubicacion $ubicacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ubicacion_delete', array('id' => $ubicacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
