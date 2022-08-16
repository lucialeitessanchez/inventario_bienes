<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checkrequisitos
 *
 * @ORM\Table(name="checkRequisitos")
 * @ORM\Entity
 */
class Checkrequisitos
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcheckRequisitos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcheckrequisitos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="detalleRequisito", type="string", length=45, nullable=true)
     */
    private $detallerequisito;

    /**
     * @var string|null
     *
     * @ORM\Column(name="validoPara", type="string", length=45, nullable=true)
     */
    private $validopara;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechabaja;

    public function getIdcheckrequisitos(): ?int
    {
        return $this->idcheckrequisitos;
    }

    public function getDetallerequisito(): ?string
    {
        return $this->detallerequisito;
    }

    public function setDetallerequisito(?string $detallerequisito): self
    {
        $this->detallerequisito = $detallerequisito;

        return $this;
    }

    public function getValidopara(): ?string
    {
        return $this->validopara;
    }

    public function setValidopara(?string $validopara): self
    {
        $this->validopara = $validopara;

        return $this;
    }

    public function getFechabaja(): ?\DateTimeInterface
    {
        return $this->fechabaja;
    }

    public function setFechabaja(?\DateTimeInterface $fechabaja): self
    {
        $this->fechabaja = $fechabaja;

        return $this;
    }

public function getDescripcionCheck(){
    return $this->detallerequisito.' ('.$this->validopara.')';
}
}
