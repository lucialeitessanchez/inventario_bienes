<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\ResponsableArea;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Responsablearea controller.
 *
 */
class ResponsableAreaController extends Controller
{
    /**
     * Lists all responsableArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $responsableAreas = $em->getRepository('BienesBundle:ResponsableArea')->findAll();

        return $this->render('responsablearea/index.html.twig', array(
            'responsableAreas' => $responsableAreas,
        ));
    }

    /**
     * Creates a new responsableArea entity.
     *
     */
    public function newAction(Request $request)
    {
        $responsableArea = new Responsablearea();
        $form = $this->createForm('BienesBundle\Form\ResponsableAreaType', $responsableArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($responsableArea);
            $em->flush();

            return $this->redirectToRoute('responsablearea_show', array('id' => $responsableArea->getId()));
        }

        return $this->render('responsablearea/new.html.twig', array(
            'responsableArea' => $responsableArea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a responsableArea entity.
     *
     */
    public function showAction(ResponsableArea $responsableArea)
    {
        $deleteForm = $this->createDeleteForm($responsableArea);

        return $this->render('responsablearea/show.html.twig', array(
            'responsableArea' => $responsableArea,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing responsableArea entity.
     *
     */
    public function editAction(Request $request, ResponsableArea $responsableArea)
    {
        $deleteForm = $this->createDeleteForm($responsableArea);
        $editForm = $this->createForm('BienesBundle\Form\ResponsableAreaType', $responsableArea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsablearea_edit', array('id' => $responsableArea->getId()));
        }

        return $this->render('responsablearea/edit.html.twig', array(
            'responsableArea' => $responsableArea,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a responsableArea entity.
     *
     */
    public function deleteAction(Request $request, ResponsableArea $responsableArea)
    {
        $form = $this->createDeleteForm($responsableArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($responsableArea);
            $em->flush();
        }

        return $this->redirectToRoute('responsablearea_index');
    }

    /**
     * Creates a form to delete a responsableArea entity.
     *
     * @param ResponsableArea $responsableArea The responsableArea entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResponsableArea $responsableArea)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsablearea_delete', array('id' => $responsableArea->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
