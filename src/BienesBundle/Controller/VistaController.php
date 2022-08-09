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

    public function bienEnDesusoAction() {

        return $this->render('vista/vista_09_bi_desuso.html.twig');
    }

    public function bienInactivoAction() {

        return $this->render('vista/vista_10_bi_inactivo.html.twig');
    }

    public function bienActivoAction() {

        return $this->render('vista/vista_11_bi_activo.html.twig');
    }

    public function bienBajaAction() {

        return $this->render('vista/vista_12_bi_baja.html.twig');
    }

    public function abmBienAction() {

        return $this->render('vista/vista_abm_bien.html.twig');
    }

    public function abmTipoAction() {

        return $this->render('vista/vista_abm_tipo.html.twig');
    }

    public function edicionBienAction() {

        return $this->render('vista/vista_edicionBien.html.twig');
    }

    public function abmUbicacionAction() {

        return $this->render('vista/vista_abm_ubicacion.html.twig');
    }

    public function abmOficinaAction() {

        return $this->render('vista/vista_abm_oficina.html.twig');
    }

    public function abmRespoAreaAction() {

        return $this->render('vista/vista_abm_respoArea.html.twig');
    }

     public function abmResponsableAction() {

        return $this->render('vista/vista_abm_responsable.html.twig');
    }
    public function egresoStockAction() {

        return $this->render('vista/vista_egreso_stock.html.twig');
    }

}
