<?php

namespace MDS\RuinstitucionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RuinstitucionesBundle:Default:index.html.twig');
    }
}
