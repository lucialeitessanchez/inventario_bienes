<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadoactoadministrativo
 *
 * @ORM\Table(name="estadoActoAdministrativo")
 * @ORM\Entity
 */
class Estadoactoadministrativo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idestado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestado;

    /**
     * @var string
     *
     * @ORM\Column(name="estadoDescripcion", type="string", length=45, nullable=false)
     */
    private $estadodescripcion;

    public function getIdestado(): ?int
    {
        return $this->idestado;
    }

    public function getEstadodescripcion(): ?string
    {
        return $this->estadodescripcion;
    }

    public function setEstadodescripcion(string $estadodescripcion): self
    {
        $this->estadodescripcion = $estadodescripcion;

        return $this;
    }


}
