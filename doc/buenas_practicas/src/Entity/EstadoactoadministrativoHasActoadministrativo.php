<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoactoadministrativoHasActoadministrativo
 *
 * @ORM\Table(name="estadoActoAdministrativo_has_actoAdministrativo", indexes={@ORM\Index(name="fk_estadoActoAdministrativo_has_actoAdministrativo_estadoAc_idx", columns={"estadoActoAdministrativo_idestado"}), @ORM\Index(name="fk_estadoActoAdministrativo_has_actoAdministrativo_actoAdmi_idx", columns={"actoAdministrativo_idActoAdministrativo"})})
 * @ORM\Entity
 */
class EstadoactoadministrativoHasActoadministrativo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idestadoActo_has_actoAdministrativo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestadoactoHasActoadministrativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEstado", type="date", nullable=false)
     */
    private $fechaestado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacionEstado", type="text", length=65535, nullable=true)
     */
    private $observacionestado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCarga", type="datetime", nullable=false)
     */
    private $fechacarga;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=45, nullable=false)
     */
    private $usuario;

    /**
     * @var \Estadoactoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Estadoactoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadoActoAdministrativo_idestado", referencedColumnName="idestado")
     * })
     */
    private $estadoactoadministrativoIdestado;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    public function getIdestadoactoHasActoadministrativo(): ?int
    {
        return $this->idestadoactoHasActoadministrativo;
    }

    public function getFechaestado(): ?\DateTimeInterface
    {
        return $this->fechaestado;
    }

    public function setFechaestado(\DateTimeInterface $fechaestado): self
    {
        $this->fechaestado = $fechaestado;

        return $this;
    }

    public function getObservacionestado(): ?string
    {
        return $this->observacionestado;
    }

    public function setObservacionestado(?string $observacionestado): self
    {
        $this->observacionestado = $observacionestado;

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

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getEstadoactoadministrativoIdestado(): ?Estadoactoadministrativo
    {
        return $this->estadoactoadministrativoIdestado;
    }

    public function setEstadoactoadministrativoIdestado(?Estadoactoadministrativo $estadoactoadministrativoIdestado): self
    {
        $this->estadoactoadministrativoIdestado = $estadoactoadministrativoIdestado;

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
