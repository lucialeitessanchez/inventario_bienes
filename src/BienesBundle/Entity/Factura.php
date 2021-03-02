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
     * @ORM\Column(name="montoUnitario", type="float")
     */
    private $montoUnitario;

    /**
     * @var float
     *
     * @ORM\Column(name="montoTotal", type="float")
     */
    private $montoTotal;

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

    /**
     * Set proveedor
     *
     * @param \BienesBundle\Entity\Proveedor $proveedor
     *
     * @return Factura
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
     * Set montoTotal
     *
     * @param float $montoTotal
     *
     * @return Factura
     */
    public function setMontoTotal($montoTotal)
    {
        $this->montoTotal = $montoTotal;

        return $this;
    }

    /**
     * Get montoTotal
     *
     * @return float
     */
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }

    /**
     * Set montoUnitario
     *
     * @param float $montoUnitario
     *
     * @return Factura
     */
    public function setMontoUnitario($montoUnitario)
    {
        $this->montoUnitario = $montoUnitario;

        return $this;
    }

    /**
     * Get montoUnitario
     *
     * @return float
     */
    public function getMontoUnitario()
    {
        return $this->montoUnitario;
    }
}
