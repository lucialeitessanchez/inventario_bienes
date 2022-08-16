<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObservacionesBp
 *
 * @ORM\Table(name="observaciones_bp", indexes={@ORM\Index(name="fk_observaciones_bp_actoAdministrativo1_idx", columns={"actoAdministrativo_idActoAdministrativo"}), @ORM\Index(name="fecha_obs", columns={"fechaObs"})})
 * @ORM\Entity
 */
class ObservacionesBp
{
    /**
     * @var int
     *
     * @ORM\Column(name="idObservacionActoAdministrativo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idobservacionactoadministrativo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="text", length=65535, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaObs", type="date", nullable=true)
     */
    private $fechaobs;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=45, nullable=false)
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCarga", type="datetime", nullable=false)
     */
    private $fechacarga;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    public function getIdobservacionactoadministrativo(): ?int
    {
        return $this->idobservacionactoadministrativo;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getFechaobs(): ?\DateTimeInterface
    {
        return $this->fechaobs;
    }

    public function setFechaobs(?\DateTimeInterface $fechaobs): self
    {
        $this->fechaobs = $fechaobs;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechacarga(): ?\DateTimeInterface
    {
        return $this->fechacarga;
    }

    public function setFechacarga(\DateTimeInterface $fechacarga): self
    {
        $this->fechacarga = $fechacarga;

        return $this;
    }

    public function getActoadministrativoIdactoadministrativo(): ?Actoadministrativo
    {
        return $this->actoadministrativoIdactoadministrativo;
    }

    public function setActoadministrativoIdactoadministrativo(?Actoadministrativo $actoadministrativoIdactoadministrativo): self
    {
        $this->actoadministrativoIdactoadministrativo = $actoadministrativoIdactoadministrativo;

        return $this;
    }


}
