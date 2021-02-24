<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Responsable
 *
 * @ORM\Table(name="responsable")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\ResponsableRepository")
 */
class Responsable
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="dni", type="float")
     */
    private $dni;

    /**
     * @var bool
     *
     * @ORM\Column(name="funcionario", type="boolean")
     */
    private $funcionario;

    /**
     * @ORM\OneToMany(targetEntity="Bien", mappedBy="bien")
     */
    private $bienes;

    /**
     * @ORM\ManyToOne(targetEntity="ResponsableArea", inversedBy="responsables")
     * @ORM\JoinColumn(name="id_responsableArea", referencedColumnName="id")
     */
    private $responsableArea;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Responsable
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
     * Set funcionario
     *
     * @param boolean $funcionario
     *
     * @return Responsable
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return bool
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bienes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dni
     *
     * @param float $dni
     *
     * @return Responsable
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return float
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Add biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     *
     * @return Responsable
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
     * Set responsableArea
     *
     * @param \BienesBundle\Entity\ResponsableArea $responsableArea
     *
     * @return Responsable
     */
    public function setResponsableArea(\BienesBundle\Entity\ResponsableArea $responsableArea = null)
    {
        $this->responsableArea = $responsableArea;

        return $this;
    }

    /**
     * Get responsableArea
     *
     * @return \BienesBundle\Entity\ResponsableArea
     */
    public function getResponsableArea()
    {
        return $this->responsableArea;
    }
}
