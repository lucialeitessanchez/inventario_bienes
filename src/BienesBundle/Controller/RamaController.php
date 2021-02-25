<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Rama;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rama controller.
 *
 */
class RamaController extends Controller
{
    /**
     * Lists all rama entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ramas = $em->getRepository('BienesBundle:Rama')->findAll();

        return $this->render('rama/index.html.twig', array(
            'ramas' => $ramas,
        ));
    }

    /**
     * Creates a new rama entity.
     *
     */
    public function newAction(Request $request)
    {
        $rama = new Rama();
        $form = $this->createForm('BienesBundle\Form\RamaType', $rama);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rama);
            $em->flush();

            return $this->redirectToRoute('rama_show', array('id' => $rama->getId()));
        }

        return $this->render('rama/new.html.twig', array(
            'rama' => $rama,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rama entity.
     *
     */
    public function showAction(Rama $rama)
    {
        $deleteForm = $this->createDeleteForm($rama);

        return $this->render('rama/show.html.twig', array(
            'rama' => $rama,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rama entity.
     *
     */
    public function editAction(Request $request, Rama $rama)
    {
        $deleteForm = $this->createDeleteForm($rama);
        $editForm = $this->createForm('BienesBundle\Form\RamaType', $rama);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rama_edit', array('id' => $rama->getId()));
        }

        return $this->render('rama/edit.html.twig', array(
            'rama' => $rama,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rama entity.
     *
     */
    public function deleteAction(Request $request, Rama $rama)
    {
        $form = $this->createDeleteForm($rama);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rama);
            $em->flush();
        }

        return $this->redirectToRoute('rama_index');
    }

    /**
     * Creates a form to delete a rama entity.
     *
     * @param Rama $rama The rama entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rama $rama)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rama_delete', array('id' => $rama->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
