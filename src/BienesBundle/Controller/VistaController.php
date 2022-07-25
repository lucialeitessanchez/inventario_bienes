<?php

namespace BienesBundle\Controller;

use BienesBundle\Entity\Rama;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rama controller.
 *
 */
class VistaController extends Controller {

    /**
     * Lists all rama entities.
     *
     */
    public function indexAction() {

        return $this->render('vista/index.html.twig');
    }

    public function altaFacturaAction() {

        return $this->render('vista/vista_factura_alta.html.twig');
    }

    public function altaBienAction() {

        return $this->render('vista/vista_01_ingreso.html.twig');
    }
    
    public function asignacionBienAction() {

        return $this->render('vista/vista_02_asignacion.html.twig');
    }

}
