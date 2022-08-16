<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoInstitucion
 *
 * @ORM\Table(name="Tipo_Institucion")
 * @ORM\Entity
 */
class TipoInstitucion
{
    /**
     * @var int
     *
     * @ORM\Column(name="tip_inst_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tipInstId;

    /**
     * @var int
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
     */
    private $doctrineVersion = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tip_inst_desc", type="string", length=255, nullable=true)
     */
    private $tipInstDesc;

    public function getTipInstId(): ?int
    {
        return $this->tipInstId;
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

    public function getTipInstDesc(): ?string
    {
        return $this->tipInstDesc;
    }

    public function setTipInstDesc(?string $tipInstDesc): self
    {
        $this->tipInstDesc = $tipInstDesc;

        return $this;
    }


}
