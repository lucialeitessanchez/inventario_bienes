<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * */
class DetallecomponenteBase {

    /**
     * @var int
     *
     * @ORM\Column(name="iddetalleComponente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddetallecomponente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="detalleComponente", type="string", length=100, nullable=true)
     */
    private $detallecomponente;

    /**
     * @var \Componente
     * @ORM\ManyToOne(targetEntity="Componente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="componente_idComponente", referencedColumnName="idComponente")
     * })
     */
    private $componenteIdcomponente;

    public function getIddetallecomponente(): ?int {
        return $this->iddetallecomponente;
    }

    public function getDetallecomponente(): ?string {
        return $this->detallecomponente;
    }

    public function setDetallecomponente(?string $detallecomponente): self {
        $this->detallecomponente = $detallecomponente;

        return $this;
    }

    public function getComponenteIdcomponente(): ?Componente {
        return $this->componenteIdcomponente;
    }

    public function setComponenteIdcomponente(?Componente $componenteIdcomponente): self {
        $this->componenteIdcomponente = $componenteIdcomponente;

        return $this;
    }

}
