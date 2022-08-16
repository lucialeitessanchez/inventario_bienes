<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity
 */
class Area
{
    /**
     * @var int
     *
     * @ORM\Column(name="idArea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarea;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=45, nullable=false)
     */
    private $area;

    public function getIdarea(): ?int
    {
        return $this->idarea;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }


}
