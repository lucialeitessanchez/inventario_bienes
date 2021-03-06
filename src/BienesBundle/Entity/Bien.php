<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien", indexes={@ORM\Index(name="id_tipo", columns={"id_tipo"}), @ORM\Index(name="id_rama", columns={"id_rama"})}))
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\BienRepository")
 */
class Bien
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=100, unique=true)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="date")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=50)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Proveedor", inversedBy="bienes")
     * @ORM\JoinColumn(name="id_proveedor", referencedColumnName="id")
     */
    private $proveedor;

    /**
     * @ORM\ManyToOne(targetEntity="Responsable", inversedBy="bienes")
     * @ORM\JoinColumn(name="id_responsable", referencedColumnName="id")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="Ubicacion", inversedBy="bienes")
     * @ORM\JoinColumn(name="id_ubicacion", referencedColumnName="id")
     */
    private $ubicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="tipo")
     * @ORM\JoinColumn(name="id_tipo", referencedColumnName="id")
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Rama", inversedBy="bienes")
     * @ORM\JoinColumn(name="id_rama", referencedColumnName="id")
     */
    private $rama;

    /**
     * @ORM\ManyToOne(targetEntity="Factura", inversedBy="bienes")
     * @ORM\JoinColumn(name="id_factura", referencedColumnName="id")
     */
    private $factura;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Bien
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Bien
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Bien
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Bien
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set proveedor
     *
     * @param \BienesBundle\Entity\Proveedor $proveedor
     *
     * @return Bien
     */
    public function setProveedor(\BienesBundle\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \BienesBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set responsable
     *
     * @param \BienesBundle\Entity\Responsable $responsable
     *
     * @return Bien
     */
    public function setResponsable(\BienesBundle\Entity\Responsable $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \BienesBundle\Entity\Responsable
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set ubicacion
     *
     * @param \BienesBundle\Entity\Ubicacion $ubicacion
     *
     * @return Bien
     */
    public function setUbicacion(\BienesBundle\Entity\Ubicacion $ubicacion = null)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return \BienesBundle\Entity\Ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set tipo
     *
     * @param \BienesBundle\Entity\Tipo $tipo
     *
     * @return Bien
     */
    public function setTipo(\BienesBundle\Entity\Tipo $tipo = null)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \BienesBundle\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function setRama($rama){
        $this->rama = $rama;
        return $this;
    }

    public function getRama(){
        return $this->rama;
    }
    public function __toString() {
        return strval($this->getCodigo()); }

    /**
     * Set factura
     *
     * @param \BienesBundle\Entity\Factura $factura
     *
     * @return Bien
     */
    public function setFactura(\BienesBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \BienesBundle\Entity\Factura
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Bien
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
