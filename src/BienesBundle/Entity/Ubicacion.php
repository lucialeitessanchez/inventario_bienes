<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ubicacion
 *
 * @ORM\Table(name="ubicacion")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\UbicacionRepository")
 */
class Ubicacion
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
     * @ORM\Column(name="calle", type="string", length=255)
     */
    private $calle;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=255)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="oficina", type="string", length=255)
     */
    private $oficina;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255)
     */
    private $observacion;


    /**
     * @ORM\OneToMany(targetEntity="Bien", mappedBy="bien")
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
     * Set calle
     *
     * @param string $calle
     *
     * @return Ubicacion
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Ubicacion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     *
     * @return Ubicacion
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
     * Set oficina
     *
     * @param string $oficina
     *
     * @return Ubicacion
     */
    public function setOficina($oficina)
    {
        $this->oficina = $oficina;

        return $this;
    }

    /**
     * Get oficina
     *
     * @return string
     */
    public function getOficina()
    {
        return $this->oficina;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Ubicacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bienes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     *
     * @return Ubicacion
     */
    public function addBiene(\BienesBundle\Entity\Bien $biene)
    {
        $this->bienes[] = $biene;

        return $this;
    }

    /**
     * Remove biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     */
    public function removeBiene(\BienesBundle\Entity\Bien $biene)
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

    public function getCalleNum(){
        return ($this->calle)." ".($this->numero);
    }

    public function __toString() {
        return strval($this->getCalleNum()); }
}
