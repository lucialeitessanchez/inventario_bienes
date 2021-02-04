<?php

namespace BienesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BienesBundle\Form\UserType;
use BienesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Registrousuarios controller.
 *
 */
class RegistroController extends Controller
{
    public function registerAction(Request $request)
    {
        // 1) Construimos el formulario
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) Manejamos el envío (sólo pasará con POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Codificamos el password (también se puede hacer a través de un Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) Guardar el User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... hacer cualquier otra cosa, como enviar un email, etc
            // establecer un mensaje "flash" de éxito para el usuario

            return $this->redirectToRoute('reemplazar_con_una_route');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
