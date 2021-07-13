<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\TipoRepository")
 */
class Tipo
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
     * @ORM\Column(name="tipo", type="string", length=255, unique=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreTipo", type="string", length=255)
     */
    private $nombreTipo;

    /**
     * @ORM\OneToMany(targetEntity="Bien", mappedBy="bien")
     */
    private $bienes;

    /**
     * @ORM\OneToMany(targetEntity="Rama", mappedBy="tipo")
     */
    private $ramas;

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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set nombreTipo
     *
     * @param string $nombreTipo
     *
     * @return Tipo
     */
    public function setNombreTipo($nombreTipo)
    {
        $this->nombreTipo = $nombreTipo;

        return $this;
    }

    /**
     * Get nombreTipo
     *
     * @return string
     */
    public function getNombreTipo()
    {
        return $this->nombreTipo;
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
     * @return Tipo
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




    /**
     * Add rama
     *
     * @param \BienesBundle\Entity\Rama $rama
     *
     * @return Tipo
     */
    public function addRama(\BienesBundle\Entity\Rama $rama)
    {
        $this->ramas[] = $rama;

        return $this;
    }

    /**
     * Remove rama
     *
     * @param \BienesBundle\Entity\Rama $rama
     */
    public function removeRama(\BienesBundle\Entity\Rama $rama)
    {
        $this->ramas->removeElement($rama);
    }

    /**
     * Get ramas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRamas()
    {
        return $this->ramas;
    }


    public function __toString() {
        return strval($this->getNombreTipo());
    }

}
