<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipodocumento
 *
 * @ORM\Table(name="tipoDocumento")
 * @ORM\Entity
 */
class Tipodocumento {

    /**
     * @var int
     *
     * @ORM\Column(name="idtipo_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="descripciondocumento", type="string", length=45, nullable=false)
     */
    private $descripciondocumento;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechabaja", type="datetime", nullable=true)
     */
    private $fechabaja;

    /**
     * @var int|null
     *
     * @ORM\Column(name="area", type="integer", nullable=false)
     */
    private $area;
    
    

    public function getIdtipodocumento(): ?int {
        return $this->idtipodocumento;
    }

    public function getDescripciondocumento(): ?string {
        return $this->descripciondocumento;
    }

    public function setDescripciondocumento(string $descripciondocumento): self {
        $this->descripciondocumento = $descripciondocumento;

        return $this;
    }

    public function getFechabaja(): ?\DateTimeInterface {
        return $this->fechabaja;
    }

    public function setFechabaja(\DateTimeInterface $fechabaja): self {
        $this->fechabaja = $fechabaja;

        return $this;
    }
    
    public function getArea(): ?int {
        return $this->area;
    }

    public function setArea(?int $area): self {
        $this->area = $area;

        return $this;
    }

}
