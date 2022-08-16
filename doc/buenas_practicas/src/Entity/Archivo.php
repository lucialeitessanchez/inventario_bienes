<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo")
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idarchivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrearchivo", type="string", length=45, nullable=false)
     */
    private $nombrearchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=150, nullable=false)
     */
    private $path;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaupload", type="datetime", nullable=true)
     */
    private $fechaupload;

    /**
     * @var string
     *
     * @ORM\Column(name="usuarioalta", type="string", length=50, nullable=false)
     */
    private $usuarioalta;

    /**
     * @var \Actoadministrativo
     *
     * @ORM\ManyToOne(targetEntity="Actoadministrativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actoAdministrativo_idActoAdministrativo", referencedColumnName="idActoAdministrativo")
     * })
     */
    private $actoadministrativoIdactoadministrativo;

    /**
     * @var \Tipodocumento
     *
     * @ORM\ManyToOne(targetEntity="Tipodocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoDocumento_idTipo_documento", referencedColumnName="idtipo_documento")
     * })
     */
    private $tipoDocumentoIdTipodocumento;
    
    

public function getIdarchivo(): ?int {
        return $this->idarchivo;
    }
    
   public function getNombrearchivo(): ?string {
        return $this->nombrearchivo;
    }

    public function setNombrearchivo(string $nombrearchivo): self {
        $this->nombrearchivo = $nombrearchivo;

        return $this;
    }

    public function getPath(): ?string {
        return $this->path;
    }

    public function setPath(string $path): self {
        $this->path = $path;

        return $this;
    }
    
    public function getDescripcion(): ?string {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self {
        $this->descripcion = $descripcion;

        return $this;
    }

        public function getFecha(): ?\DateTimeInterface {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self {
        $this->fecha = $fecha;

        return $this;
    }
       public function getFechaupload(): ?\DateTimeInterface {
        return $this->fechaupload;
    }

    public function setFechaupload(\DateTimeInterface $fechaupload): self {
        $this->fechaupload = $fechaupload;

        return $this;
    }
    
       public function getUsuarioalta(): ?string {
        return $this->usuarioalta;
    }

    public function setUsuarioalta(string $usuarioalta): self {
        $this->usuarioalta = $usuarioalta;

        return $this;
    }
    
       public function getActoadministrativoIdactoadministrativo(): ?Actoadministrativo {
        return $this->actoadministrativoIdactoadministrativo;
    }

    public function setActoadministrativoIdactoadministrativo(?Actoadministrativo $actoadministrativoIdactoadministrativo): self {
        $this->actoadministrativoIdactoadministrativo = $actoadministrativoIdactoadministrativo;

        return $this;
    }
    
      public function getTipoDocumentoIdTipodocumento(): ?Tipodocumento {
        return $this->tipoDocumentoIdTipodocumento;
    }

    public function setTipoDocumentoIdTipodocumento(?Tipodocumento $tipoDocumentoIdTipodocumento): self {
        $this->tipoDocumentoIdTipodocumento = $tipoDocumentoIdTipodocumento;

        return $this;
    }
}
