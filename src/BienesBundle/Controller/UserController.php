<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Rol;
use BienesBundle\Entity\User;
use BienesBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
        /**
     * Lists all user entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BienesBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     */
    public function newAction(Request $request,EncoderFactoryInterface $encoderFactory)
    {
        $user = new User();
        $form = $this->createForm('BienesBundle\Form\UserType', $user);
        $form->handleRequest($request);


        try {

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // Obtengo el encoder que utiliza para hashear la contraseña
                $encoder = $encoderFactory->getEncoder(User::class);
                // aplico el hash a la contraseña
                $passwordEncode = $encoder->encodePassword($user->getPassword(),'');
                // guardo la contraseña hash en la db
                $user->setPassword($passwordEncode);
               

                $em->persist($user);
                $em->flush();
                $this->addFlash('mensaje_success','El usuario se creo correctamente!');

                return $this->redirectToRoute('user_show', array('id' => $user->getId()));
            }

        } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            $this->addFlash('mensaje_notice','Ya existe un usuario registrado con el mismo nombre');
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     */
    public function editAction(Request $request, User $user,EncoderFactoryInterface $encoderFactory)
    {
        $originalPassword = $user->getPassword();
        $oldRoles = $user->getRoles();
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('BienesBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if ($user->getPassword()) {
                $encoder = $encoderFactory->getEncoder(User::class);
                $passwordEncode = $encoder->encodePassword($user->getPassword(),'');
                $user->setPassword($passwordEncode);
            } else $user->setPassword($originalPassword);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}