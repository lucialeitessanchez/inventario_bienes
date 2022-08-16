<?php

namespace App\Entity\ruinstituciones;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComisionDirectiva
 *
 * @ORM\Table(name="Comision_Directiva", indexes={@ORM\Index(name="IDX_D65D9A6BF751F7C3", columns={"institucion"})})
 * @ORM\Entity
 */
class ComisionDirectiva
{
    /**
     * @var int
     *
     * @ORM\Column(name="com_dir_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $comDirId;

    /**
     * @var int
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
     */
    private $doctrineVersion = 1;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="com_dir_fec_ini", type="date", nullable=true)
     */
    private $comDirFecIni;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="com_dir_fec_fin", type="date", nullable=true)
     */
    private $comDirFecFin;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="com_dir_activa", type="boolean", nullable=true)
     */
    private $comDirActiva;

    /**
     * @var int|null
     *
     * @ORM\Column(name="institucion", type="integer", nullable=true)
     */
    private $institucion;

    public function getComDirId(): ?int
    {
        return $this->comDirId;
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

    public function getComDirFecIni(): ?\DateTimeInterface
    {
        return $this->comDirFecIni;
    }

    public function setComDirFecIni(?\DateTimeInterface $comDirFecIni): self
    {
        $this->comDirFecIni = $comDirFecIni;

        return $this;
    }

    public function getComDirFecFin(): ?\DateTimeInterface
    {
        return $this->comDirFecFin;
    }

    public function setComDirFecFin(?\DateTimeInterface $comDirFecFin): self
    {
        $this->comDirFecFin = $comDirFecFin;

        return $this;
    }

    public function getComDirActiva(): ?bool
    {
        return $this->comDirActiva;
    }

    public function setComDirActiva(?bool $comDirActiva): self
    {
        $this->comDirActiva = $comDirActiva;

        return $this;
    }

    public function getInstitucion(): ?int
    {
        return $this->institucion;
    }

    public function setInstitucion(?int $institucion): self
    {
        $this->institucion = $institucion;

        return $this;
    }
}