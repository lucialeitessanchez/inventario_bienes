<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Factura;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Factura controller.
 *
 */
class FacturaController extends Controller
{
    /**
     * Lists all factura entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $facturas = $em->getRepository('BienesBundle:Factura')->findAll();

        return $this->render('factura/index.html.twig', array(
            'facturas' => $facturas,
        ));
    }

    /**
     * Creates a new factura entity.
     *
     */
    public function newAction(Request $request)
    {
        $factura = new Factura();
        $form = $this->createForm('BienesBundle\Form\FacturaType', $factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($factura);
            $em->flush();

            return $this->redirectToRoute('factura_show', array('id' => $factura->getId()));
        }

        return $this->render('factura/new.html.twig', array(
            'factura' => $factura,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a factura entity.
     *
     */
    public function showAction(Factura $factura)
    {
        $deleteForm = $this->createDeleteForm($factura);

        return $this->render('factura/show.html.twig', array(
            'factura' => $factura,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing factura entity.
     *
     */
    public function editAction(Request $request, Factura $factura)
    {
        $deleteForm = $this->createDeleteForm($factura);
        $editForm = $this->createForm('BienesBundle\Form\FacturaType', $factura);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factura_edit', array('id' => $factura->getId()));
        }

        return $this->render('factura/edit.html.twig', array(
            'factura' => $factura,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a factura entity.
     *
     */
    public function deleteAction(Request $request, Factura $factura)
    {
        $form = $this->createDeleteForm($factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($factura);
            $em->flush();
        }

        return $this->redirectToRoute('factura_index');
    }

    /**
     * Creates a form to delete a factura entity.
     *
     * @param Factura $factura The factura entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Factura $factura)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('factura_delete', array('id' => $factura->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
