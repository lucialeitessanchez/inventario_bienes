<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Bien;
use BienesBundle\Entity\Rama;
use BienesBundle\Entity\Tipo;
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

        $form->setWidget('pais', new sfWidgetFormChoice(array(
            'choices'   => array('' => 'Selecciona un país', 'us' => 'EEUU', 'ca' => 'Canada', 'uk' => 'Reino Unido', 'otro'),
            'default'   => 'uk'
        )));


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
}
