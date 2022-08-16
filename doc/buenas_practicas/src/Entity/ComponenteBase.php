<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * */
class ComponenteBase 
{
    /**
     * @var int
     *
     * @ORM\Column(name="idComponente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomponente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="componente", type="string", length=100, nullable=true)
     */
    private $componente;

    public function getIdcomponente(): ?int
    {
        return $this->idcomponente;
    }

    public function getComponente(): ?string
    {
        return $this->componente;
    }

    public function setComponente(?string $componente): self
    {
        $this->componente = $componente;

        return $this;
    }


}
