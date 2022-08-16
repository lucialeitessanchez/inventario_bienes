<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimiento", indexes={@ORM\Index(name="fk_Movimiento_actoAdministrativo1_idx", columns={"actoAdministrativo_idActoAdministrativo"}), @ORM\Index(name="fk_Movimiento_area1_idx", columns={"area_idAreaOrigen"})})
 * @ORM\Entity
 */
class Movimiento
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMovimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmovimiento;

   /**
     * @var \Area
     *
     * @ORM\ManyToOne(targetEntity="Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_idAreaDestino", referencedColumnName="idArea")
     * })
     */
    private $areaIdareadestino;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaMovimiento", type="datetime", nullable=true)
     */
    private $fechamovimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motivoMovimiento", type="string", length=0, nullable=true)
     */
    private $motivomovimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="text", length=65535, nullable=true)
     */
    private $observacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="folios", type="integer", nullable=true)
     */
    private $folios;

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
     * @var string
     *
     * @ORM\Column(name="tipoMovimiento", type="string", length=0, nullable=false, options={"default"="INTERNO"})
     */
    private $tipomovimiento = 'INTERNO';

    /**
     * @var \Area
     *
     * @ORM\ManyToOne(targetEntity="Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_idAreaOrigen", referencedColumnName="idArea")
     * })
     */
    private $areaIdareaorigen;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    public function getIdmovimiento(): ?int
    {
        return $this->idmovimiento;
    }

    public function getAreaIdareadestino(): ?Area
    {
        return $this->areaIdareadestino;
    }

    public function setAreaIdareadestino(?Area $areaIdareadestino): self
    {
        $this->areaIdareadestino = $areaIdareadestino;

        return $this;
    }

    public function getFechamovimiento(): ?\DateTimeInterface
    {
        return $this->fechamovimiento;
    }

    public function setFechamovimiento(?\DateTimeInterface $fechamovimiento): self
    {
        $this->fechamovimiento = $fechamovimiento;

        return $this;
    }

    public function getMotivomovimiento(): ?string
    {
        return $this->motivomovimiento;
    }

    public function setMotivomovimiento(?string $motivomovimiento): self
    {
        $this->motivomovimiento = $motivomovimiento;

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

    public function getFolios(): ?int
    {
        return $this->folios;
    }

    public function setFolios(?int $folios): self
    {
        $this->folios = $folios;

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

    public function getTipomovimiento(): ?string
    {
        return $this->tipomovimiento;
    }

    public function setTipomovimiento(string $tipomovimiento): self
    {
        $this->tipomovimiento = $tipomovimiento;

        return $this;
    }

    public function getAreaIdareaorigen(): ?Area
    {
        return $this->areaIdareaorigen;
    }

    public function setAreaIdareaorigen(?Area $areaIdareaorigen): self
    {
        $this->areaIdareaorigen = $areaIdareaorigen;

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
