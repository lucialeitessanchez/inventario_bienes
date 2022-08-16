<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoReg
 *
 * @ORM\Table(name="Estado_Reg")
 * @ORM\Entity
 */
class EstadoReg
{
    /**
     * @var int
     *
     * @ORM\Column(name="est_reg_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $estRegId;

    /**
     * @var int
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
     */
    private $doctrineVersion = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="est_reg_nom", type="string", length=255, nullable=true)
     */
    private $estRegNom;

    public function getEstRegId(): ?int
    {
        return $this->estRegId;
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

    public function getEstRegNom(): ?string
    {
        return $this->estRegNom;
    }

    public function setEstRegNom(?string $estRegNom): self
    {
        $this->estRegNom = $estRegNom;

        return $this;
    }


}
