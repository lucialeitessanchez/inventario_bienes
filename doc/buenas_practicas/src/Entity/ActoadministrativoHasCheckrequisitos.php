<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActoadministrativoHasCheckrequisitos
 *
 * @ORM\Table(name="actoAdministrativo_has_checkRequisitos", 
 * indexes={@ORM\Index(name="fk_actoAdministrativo_has_checkRequisitos_actoAdministrativ_idx", columns={"actoAdministrativo_idActoAdministrativo"}), @ORM\Index(name="fk_actoAdministrativo_has_checkRequisitos_checkRequisitos1_idx", columns={"checkRequisitos_idcheckRequisitos"})})
 * @ORM\Entity
 */
class ActoadministrativoHasCheckrequisitos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaControl", type="datetime", nullable=true)
     */
    private $fechacontrol;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaCarga", type="datetime", nullable=true)
     */
    private $fechacarga;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usuario", type="string", length=45, nullable=true)
     */
    private $usuario;

    /**
     * @var \Actoadministrativo
     * @ORM\OneToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    /**
     * @var \Checkrequisitos
     * @ORM\OneToOne(targetEntity="Checkrequisitos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="checkRequisitos_idcheckRequisitos", referencedColumnName="idcheckRequisitos")
     * })
     */
    private $checkrequisitosIdcheckrequisitos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechacontrol(): ?\DateTimeInterface
    {
        return $this->fechacontrol;
    }

    public function setFechacontrol(?\DateTimeInterface $fechacontrol): self
    {
        $this->fechacontrol = $fechacontrol;

        return $this;
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

    public function getFechacarga(): ?\DateTimeInterface
    {
        return $this->fechacarga;
    }

    public function setFechacarga(?\DateTimeInterface $fechacarga): self
    {
        $this->fechacarga = $fechacarga;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(?string $usuario): self
    {
        $this->usuario = $usuario;

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

    public function getCheckrequisitosIdcheckrequisitos(): ?Checkrequisitos
    {
        return $this->checkrequisitosIdcheckrequisitos;
    }

    public function setCheckrequisitosIdcheckrequisitos(?Checkrequisitos $checkrequisitosIdcheckrequisitos): self
    {
        $this->checkrequisitosIdcheckrequisitos = $checkrequisitosIdcheckrequisitos;

        return $this;
    }


}
