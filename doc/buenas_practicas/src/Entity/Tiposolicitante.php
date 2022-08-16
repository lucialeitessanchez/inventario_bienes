<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiposolicitante
 *
 * @ORM\Table(name="tipoSolicitante")
 * @ORM\Entity
 */
class Tiposolicitante
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtipoSolicitante", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtiposolicitante;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=true)
     */
    private $descripcion;

    public function getIdtiposolicitante(): ?int
    {
        return $this->idtiposolicitante;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }


}
