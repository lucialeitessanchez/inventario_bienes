<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\ProveedorRepository")
 */
class Proveedor
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
     * @ORM\Column(name="cuil", type="float", unique=true)
     */
    private $cuil;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=100)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=100)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=100)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="organismo_publico", type="boolean", nullable=true)
     */
    private $organismo_publico;


    /**
     * @ORM\OneToMany(targetEntity="Factura", mappedBy="proveedor")
     */
    private $facturas;

    public function __construct()
    {
        $this->facturas = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Factura", mappedBy="proveedor")
     */
    private $bienes;


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
     * Set cuil
     *
     * @param float $cuil
     *
     * @return Proveedor
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;

        return $this;
    }

    /**
     * Get cuil
     *
     * @return float
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Proveedor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Proveedor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     *
     * @return Proveedor
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Proveedor
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Proveedor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add factura
     *
     * @param \BienesBundle\Entity\Factura $factura
     *
     * @return Proveedor
     */
    public function addFactura(\BienesBundle\Entity\Factura $factura)
    {
        $this->facturas[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \BienesBundle\Entity\Factura $factura
     */
    public function removeFactura(\BienesBundle\Entity\Factura $factura)
    {
        $this->facturas->removeElement($factura);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturas()
    {
        return $this->facturas;
    }

    /**
     * Add biene
     *
     * @param \BienesBundle\Entity\Factura $biene
     *
     * @return Proveedor
     */
    public function addBiene(\BienesBundle\Entity\Factura $biene)
    {
        $this->bienes[] = $biene;

        return $this;
    }

    /**
     * Remove biene
     *
     * @param \BienesBundle\Entity\Factura $biene
     */
    public function removeBiene(\BienesBundle\Entity\Factura $biene)
    {
        $this->bienes->removeElement($biene);
    }

    /**
     * Get bienes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBienes()
    {
        return $this->bienes;
    }

    public function __toString() {
        return strval($this->getNombre()); }

    /**
     * Set organismoPublico
     *
     * @param boolean $organismoPublico
     *
     * @return Proveedor
     */
    public function setOrganismoPublico($organismoPublico)
    {
        $this->organismo_publico = $organismoPublico;

        return $this;
    }

    /**
     * Get organismoPublico
     *
     * @return boolean
     */
    public function getOrganismoPublico()
    {
        return $this->organismo_publico;
    }
}
