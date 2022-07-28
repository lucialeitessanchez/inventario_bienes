<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Rol;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rol controller.
 *
 */
class RolController extends Controller
{
    /**
     * Lists all rol entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rols = $em->getRepository('BienesBundle:Rol')->findAll();

        return $this->render('rol/index.html.twig', array(
            'rols' => $rols,
        ));
    }

    /**
     * Creates a new rol entity.
     *
     */
    public function newAction(Request $request)
    {
        $rol = new Rol();
        $form = $this->createForm('BienesBundle\Form\RolType', $rol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->flush();

            return $this->redirectToRoute('rol_show', array('idRol' => $rol->getIdrol()));
        }

        return $this->render('rol/new.html.twig', array(
            'rol' => $rol,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rol entity.
     *
     */
    public function showAction(Rol $rol)
    {
        $deleteForm = $this->createDeleteForm($rol);

        return $this->render('rol/show.html.twig', array(
            'rol' => $rol,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rol entity.
     *
     */
    public function editAction(Request $request, Rol $rol)
    {
        $deleteForm = $this->createDeleteForm($rol);
        $editForm = $this->createForm('BienesBundle\Form\RolType', $rol);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rol_edit', array('idRol' => $rol->getIdrol()));
        }

        return $this->render('rol/edit.html.twig', array(
            'rol' => $rol,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rol entity.
     *
     */
    public function deleteAction(Request $request, Rol $rol)
    {
        $form = $this->createDeleteForm($rol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rol);
            $em->flush();
        }

        return $this->redirectToRoute('rol_index');
    }

    /**
     * Creates a form to delete a rol entity.
     *
     * @param Rol $rol The rol entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rol $rol)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rol_delete', array('idRol' => $rol->getIdrol())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
