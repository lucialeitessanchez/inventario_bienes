<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rama
 *
 * @ORM\Table(name="rama")
 * @ORM\Entity(repositoryClass="BienesBundle\Repository\RamaRepository")
 */
class Rama
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
     * @ORM\Column(name="nombreRama", type="string", length=255, unique=true)
     */
    private $nombreRama;

    /**
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="ramas")
     * @ORM\JoinColumn(name="id_tipo", referencedColumnName="id")
     */
    private $tipo;

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
     * Set nombreRama
     *
     * @param string $nombreRama
     *
     * @return Rama
     */
    public function setNombreRama($nombreRama)
    {
        $this->nombreRama = $nombreRama;

        return $this;
    }

    /**
     * Get nombreRama
     *
     * @return string
     */
    public function getNombreRama()
    {
        return $this->nombreRama;
    }

    /**
     * Set tipo
     *
     * @param \BienesBundle\Entity\Tipo $tipo
     *
     * @return Rama
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
}
