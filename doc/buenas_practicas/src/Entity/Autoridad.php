<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoridad
 *
 * @ORM\Table(name="autoridad", indexes={@ORM\Index(name="fk_autoridad_actoAdministrativo1_idx", columns={"actoAdministrativo_idActoAdministrativo"})})
 * @ORM\Entity
 */
class Autoridad
{
    /**
     * @var int
     *
     * @ORM\Column(name="idautoridad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idautoridad;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=45, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=45, nullable=false)
     */
    private $cargo;

    /**
     * @var int
     *
     * @ORM\Column(name="idpersonas", type="integer", nullable=false)
     */
    private $idpersonas;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    public function getIdautoridad(): ?int
    {
        return $this->idautoridad;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getIdpersonas(): ?int
    {
        return $this->idpersonas;
    }

    public function setIdpersonas(int $idpersonas): self
    {
        $this->idpersonas = $idpersonas;

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
