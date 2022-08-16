<?php

namespace App\Entity\tablascomunes;

use Doctrine\ORM\Mapping as ORM;

/**
 * TLoc
 *
 * @ORM\Table(name="t_loc", indexes={@ORM\Index(name="loc", columns={"loc"})})
 * @ORM\Entity
 */
class TLoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_loc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLoc = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="circ", type="integer", nullable=true)
     */
    private $circ;

    /**
     * @var string|null
     *
     * @ORM\Column(name="loc", type="string", length=50, nullable=true, options={"fixed"=true})
     */
    private $loc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depto", type="string", length=50, nullable=true, options={"fixed"=true})
     */
    private $depto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_nodo", type="integer", nullable=true)
     */
    private $idNodo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="microregion", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $microregion;

    public function getIdLoc(): ?int
    {
        return $this->idLoc;
    }

    public function getCirc(): ?int
    {
        return $this->circ;
    }

    public function setCirc(?int $circ): self
    {
        $this->circ = $circ;

        return $this;
    }

    public function getLoc(): ?string
    {
        return $this->loc;
    }

    public function setLoc(?string $loc): self
    {
        $this->loc = $loc;

        return $this;
    }

    public function getDepto(): ?string
    {
        return $this->depto;
    }

    public function setDepto(?string $depto): self
    {
        $this->depto = $depto;

        return $this;
    }

    public function getIdNodo(): ?int
    {
        return $this->idNodo;
    }

    public function setIdNodo(?int $idNodo): self
    {
        $this->idNodo = $idNodo;

        return $this;
    }

    public function getMicroregion(): ?string
    {
        return $this->microregion;
    }

    public function setMicroregion(?string $microregion): self
    {
        $this->microregion = $microregion;

        return $this;
    }


}
