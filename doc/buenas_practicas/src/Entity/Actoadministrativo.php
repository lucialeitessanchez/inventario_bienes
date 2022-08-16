<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Actoadministrativo
 *
 * @ORM\Table(name="actoAdministrativo", indexes={@ORM\Index(name="fk_actoAdministrativo_tipoInstitucionBP1_idx", columns={"tipoSolicitante_idtipoSolicitante"}), @ORM\Index(name="fecha_solicitud", columns={"fechaNota"})})
 * @ORM\Entity 
 */
class Actoadministrativo extends ActoadministrativoBase {

    // protected $localidad;
    protected $checkrequisitosIdcheckrequisitos;
    protected $detallerequisito;
    
    protected $brochure;

    function getDetallerequisito() {
        return $this->detallerequisito;
    }

    function setDetallerequisito($detallerequisito): void {
        $this->detallerequisito = $detallerequisito;
    }

    protected $arrayComponenteDescripcion;
    protected $itemComponente;
    protected $detallecomponenteIddetallecomponentesolicitado;
    protected $detallecomponenteIddetallecomponenteaprobado;

    function getDetallecomponenteIddetallecomponenteaprobado() {
        return $this->detallecomponenteIddetallecomponenteaprobado;
    }

    function setDetallecomponenteIddetallecomponenteaprobado($detallecomponenteIddetallecomponenteaprobado) {
        $this->detallecomponenteIddetallecomponenteaprobado = $detallecomponenteIddetallecomponenteaprobado;
    }

    function getDetallecomponenteIddetallecomponentesolicitado() {
        return $this->detallecomponenteIddetallecomponentesolicitado;
    }

    function setDetallecomponenteIddetallecomponentesolicitado($detallecomponenteIddetallecomponentesolicitado) {
        $this->detallecomponenteIddetallecomponentesolicitado = $detallecomponenteIddetallecomponentesolicitado;
    }

    function getCheckrequisitosIdcheckrequisitos() {
        return $this->checkrequisitosIdcheckrequisitos;
    }

    function setCheckrequisitosIdcheckrequisitos($checkrequisitosIdcheckrequisitos) {
        $this->checkrequisitosIdcheckrequisitos = $checkrequisitosIdcheckrequisitos;
    }

    /**
     * @ORM\OneToMany(targetEntity="ActoadministrativoHasComponente", mappedBy="actoadministrativoIdactoadministrativo")
     * */
    protected $listaComponentes;

    function __construct() {
        $this->listaComponentes = new ArrayCollection();
    }

      protected $localidad;

    function getLocalidad() {
        return $this->localidad;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function getArrayComponenteDescripcion() {
        return $this->arrayComponenteDescripcion;
    }

    function setArrayComponenteDescripcion($arrayComponenteDescripcion) {
        $this->arrayComponenteDescripcion = $arrayComponenteDescripcion;
    }

    function getItemComponente() {
        return $this->itemComponente;
    }

    function setItemComponente($itemComponente) {
        $this->itemComponente = $itemComponente;
    }

    function getListaComponentes() {
        return $this->listaComponentes;
    }

    function setListaComponentes($listaComponentes) {
        $this->listaComponentes = $listaComponentes;
    }
    
    function getBrochure() {
        return $this->brochure;
    }

    function setBrochure($brochure) {
        $this->brochure = $brochure;
    }

}
