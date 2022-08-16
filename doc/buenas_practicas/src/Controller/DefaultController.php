<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/default")
 */
class DefaultController extends AbstractController {

    /**
     * @Route(path="/index/{idApp}/{idUser}/{token}", name="default_index", requirements={"idUser"="\d+","idApp"="\d+"})
     */
    public function indexAction($idApp, $idUser, $token) {
        return $this->render('base_bs.html.twig', [

                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'idApp' => $idApp,
                    'usuario' => $idUser,
                    'token' => $token
        ]);
    }

    
    /**
     * @Route(path="/inicio", name="inicio")
     */
    public function inicioAction() {
        return $this->render('base_bs.html.twig', [

                    /*'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'idApp' => $idApp,
                    'usuario' => $idUser,
                    'token' => $token*/
        ]);
    }
    
    /**
     * @Route(path="/salir", name="salir")
     */
    public function salir(Request $request) {
        return new RedirectResponse($this->getParameter('url_portal'));
    }

    /**
     * @Route(path="/finalizoSesion", name="finalizoSesion")
     */
    public function finalizoSesion(Request $request) {
        return $this->render('logout/logout.html.twig');
    }

}
