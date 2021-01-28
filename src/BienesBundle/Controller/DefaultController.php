<?php

namespace BienesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BienesBundle:Default:index.html.twig');
    }
}
