<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActoadministrativoHasComponente
 *
 * @ORM\Table(name="actoAdministrativo_has_componente", indexes={@ORM\Index(name="fk_actoAdministrativo_has_componente_actoAdministrativo1_idx", columns={"actoAdministrativo_idActoAdministrativo"}), @ORM\Index(name="fk_actoAdministrativo_has_componente_componente1_idx", columns={"componente_idComponenteSolicitado"})})
 * @ORM\Entity
 */
class ActoadministrativoHasComponente {

    /**
     * @var int
     *
     * @ORM\Column(name="idActoAdministrativo_has_componente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idactoadministrativoHasComponente;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaSolicitado", type="datetime", nullable=true)
     */
    private $fechasolicitado;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaAprobado", type="datetime", nullable=true)
     */
    private $fechaaprobado;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    //*************************************************************

    /**
     * @var \Componente
     *
     * @ORM\ManyToOne(targetEntity="Componente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="componente_idComponenteSolicitado", referencedColumnName="idComponente")
     * })
     */
    private $componenteIdcomponentesolicitado;

    /**
     * @var \Componente
     *
     * @ORM\ManyToOne(targetEntity="Componente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="componente_idComponenteAprobado", referencedColumnName="idComponente")
     * })
     */
    private $componenteIdcomponenteaprobado;

//**************************************************************    

    /**
     * @var \Detallecomponente
     *
     * @ORM\ManyToOne(targetEntity="Detallecomponente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="detalleComponente_idDetalleComponenteSolicitado", referencedColumnName="iddetalleComponente")
     * })
     */
    private $detallecomponenteIddetallecomponentesolicitado;

    /**
     * @var \Detallecomponente
     *
     * @ORM\ManyToOne(targetEntity="Detallecomponente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="detalleComponente_idDetalleComponenteAprobado", referencedColumnName="iddetalleComponente")
     * })
     */
    private $detallecomponenteIddetallecomponenteaprobado;

    public function getIdactoadministrativoHasComponente(): ?int {
        return $this->idactoadministrativoHasComponente;
    }

    public function getFechasolicitado(): ?\DateTimeInterface {
        return $this->fechasolicitado;
    }

    public function setFechasolicitado(?\DateTimeInterface $fechasolicitado): self {
        $this->fechasolicitado = $fechasolicitado;

        return $this;
    }

    public function getFechaaprobado(): ?\DateTimeInterface {
        return $this->fechaaprobado;
    }

    public function setFechaaprobado(?\DateTimeInterface $fechaaprobado): self {
        $this->fechaaprobado = $fechaaprobado;

        return $this;
    }

    public function getActoadministrativoIdactoadministrativo(): ?Actoadministrativo {
        return $this->actoadministrativoIdactoadministrativo;
    }

    public function setActoadministrativoIdactoadministrativo(?Actoadministrativo $actoadministrativoIdactoadministrativo): self {
        $this->actoadministrativoIdactoadministrativo = $actoadministrativoIdactoadministrativo;

        return $this;
    }

//***************************************************************
    public function getComponenteIdcomponentesolicitado(): ?Componente {
        return $this->componenteIdcomponentesolicitado;
    }

    public function setComponenteIdcomponentesolicitado(?Componente $componenteIdcomponentesolicitado): self {
        $this->componenteIdcomponentesolicitado = $componenteIdcomponentesolicitado;

        return $this;
    }

    public function getComponenteIdcomponenteaprobado(): ?Componente {
        return $this->componenteIdcomponenteaprobado;
    }

    public function setComponenteIdcomponenteaprobado(?Componente $componenteIdcomponenteaprobado): self {
        $this->componenteIdcomponenteaprobado = $componenteIdcomponenteaprobado;

        return $this;
    }

    //*************************************************************** 
    public function getDetallecomponenteIddetallecomponentesolicitado(): ?Detallecomponente {
        return $this->detallecomponenteIddetallecomponentesolicitado;
    }

    public function setDetallecomponenteIddetallecomponentesolicitado(?Detallecomponente $detallecomponenteIddetallecomponentesolicitado): self {
        $this->detallecomponenteIddetallecomponentesolicitado = $detallecomponenteIddetallecomponentesolicitado;

        return $this;
    }

    public function getDetallecomponenteIddetallecomponenteaprobado(): ?Detallecomponente {
        return $this->detallecomponenteIddetallecomponenteaprobado;
    }

    public function setDetallecomponenteIddetallecomponenteaprobado(?Detallecomponente $detallecomponenteIddetallecomponenteaprobado): self {
        $this->detallecomponenteIddetallecomponenteaprobado = $detallecomponenteIddetallecomponenteaprobado;

        return $this;
    }

}
