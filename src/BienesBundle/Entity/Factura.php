<?php

namespace BienesBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="factura")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\FacturaRepository")
 */
class Factura
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
     * @var float
     *
     * @ORM\Column(name="numeroFactura", type="float")
     */
    private $numeroFactura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float")
     */
    private $monto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoAdquisicion", type="string", length=255)
     */
    private $tipoAdquisicion;

    /**
     * @ORM\ManyToOne(targetEntity="Proveedor", inversedBy="facturas")
     * @ORM\JoinColumn(name="id_proveedor", referencedColumnName="id")
     */
    private $proveedor;

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
     * Set numeroFactura
     *
     * @param float $numeroFactura
     *
     * @return Factura
     */
    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;

        return $this;
    }

    /**
     * Get numeroFactura
     *
     * @return float
     */
    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Factura
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set monto
     *
     * @param float $monto
     *
     * @return Factura
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Factura
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
     * Set tipoAdquisicion
     *
     * @param string $tipoAdquisicion
     *
     * @return Factura
     */
    public function setTipoAdquisicion($tipoAdquisicion)
    {
        $this->tipoAdquisicion = $tipoAdquisicion;

        return $this;
    }

    /**
     * Get tipoAdquisicion
     *
     * @return string
     */
    public function getTipoAdquisicion()
    {
        return $this->tipoAdquisicion;
    }
}

