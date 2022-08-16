<?php

namespace App\Entity\ruinstituciones;

use Doctrine\ORM\Mapping as ORM;

/**
 * CargoAutoridad
 *
 * @ORM\Table(name="Cargo_Autoridad")
 * @ORM\Entity
 */
class CargoAutoridad
{
    /**
     * @var int
     *
     * @ORM\Column(name="cargo_aut_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cargoAutId;

    /**
     * @var int
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
     */
    private $doctrineVersion = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cargo_aut_desc", type="string", length=255, nullable=true)
     */
    private $cargoAutDesc;

    public function getCargoAutId(): ?int
    {
        return $this->cargoAutId;
    }

    public function getDoctrineVersion(): ?int
    {
        return $this->doctrineVersion;
    }

    public function setDoctrineVersion(int $doctrineVersion): self
    {
        $this->doctrineVersion = $doctrineVersion;

        return $this;
    }

    public function getCargoAutDesc(): ?string
    {
        return $this->cargoAutDesc;
    }

    public function setCargoAutDesc(?string $cargoAutDesc): self
    {
        $this->cargoAutDesc = $cargoAutDesc;

        return $this;
    }


}
