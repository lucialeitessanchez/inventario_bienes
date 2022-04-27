<?php

namespace BienesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

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
     * @ORM\OneToMany(targetEntity="Bien", mappedBy="rama")
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

    public function __toString() {
        return strval($this->getNombreRama());
    }

    /**
     * Add biene
     *
     * @param \BienesBundle\Entity\Bien $biene
     *
     * @return Rama
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
     * Constructor
     */
    public function __construct()
    {
        $this->bienes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getRamaByTipo($tipoId){
       /* $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.categoria', 'c')
            ->innerJoin('p.productoTipo', 'pt')
            ->where('c.id = :categoriaId')
            ->andWhere('pt.id = :productoTipoId')
            ->setParameter('categoriaId', $categoriaId)
            ->setParameter('productoTipoId', $productoTipoId)
        ;

        return $qb->getQuery()->getResult();*/
    }
}
