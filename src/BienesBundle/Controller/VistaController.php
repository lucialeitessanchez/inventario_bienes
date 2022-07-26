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

    public function ingresoBienAction() {

        return $this->render('vista/vista_01_ingreso.html.twig');
    }

    public function asignacionBienAction() {

        return $this->render('vista/vista_02_asignacion.html.twig');
    }

    public function prestamoBienAction() {

        return $this->render('vista/vista_03_prestamo.html.twig');
    }

    public function devolucionBienAction() {

        return $this->render('vista/vista_04_devolucion.html.twig');
    }

    public function daniadoBienAction() {

        return $this->render('vista/vista_05_daniado.html.twig');
    }

    public function envioReparacionBienAction() {

        return $this->render('vista/vista_06_envio_reparacion.html.twig');
    }

    public function devolucionReparadorBienAction() {

        return $this->render('vista/vista_07_devolucion_reparador.html.twig');
    }

    public function retornoBienReparadoAction() {

        return $this->render('vista/vista_08_retorno_bi_reparado.html.twig');
    }

}
