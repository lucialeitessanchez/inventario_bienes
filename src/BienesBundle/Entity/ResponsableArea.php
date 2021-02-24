<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResponsableArea
 *
 * @ORM\Table(name="responsable_area")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\ResponsableAreaRepository")
 */
class ResponsableArea
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
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255)
     */
    private $cargo;

    /**
     * @ORM\OneToMany(targetEntity="Responsable", mappedBy="responsableArea")
     */
    private $responsables;


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
     * @return ResponsableArea
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
     * Set cargo
     *
     * @param string $cargo
     *
     * @return ResponsableArea
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responsables = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add responsable
     *
     * @param \BienesBundle\Entity\Responsable $responsable
     *
     * @return ResponsableArea
     */
    public function addResponsable(\BienesBundle\Entity\Responsable $responsable)
    {
        $this->responsables[] = $responsable;

        return $this;
    }

    /**
     * Remove responsable
     *
     * @param \BienesBundle\Entity\Responsable $responsable
     */
    public function removeResponsable(\BienesBundle\Entity\Responsable $responsable)
    {
        $this->responsables->removeElement($responsable);
    }

    /**
     * Get responsables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    public function __toString() {
        return strval($this->getNombre()); }

}
