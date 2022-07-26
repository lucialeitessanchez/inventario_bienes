<?php

namespace BienesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * BienesBundle\Entity\Rol
 *
 * @ORM\Entity
 * @ORM\Table(name="rol")
 */
class Rol
{
  /**
     * @var string
     *
     * @ORM\Column(name="idrol", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRol;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rol_descripcion", type="string", length=45, nullable=true)
     */
    private $rolDescripcion;




       /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles", cascade={"all"}, orphanRemoval=true)
     */
    private $user;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \BienesBundle\Entity\User $user
     *
     * @return Rol
     */
    public function addUser(\BienesBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \BienesBundle\Entity\User $user
     */
    public function removeUser(\BienesBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get idRol
     *
     * @return string
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set rolDescripcion
     *
     * @param string $rolDescripcion
     *
     * @return Rol
     */
    public function setRolDescripcion($rolDescripcion)
    {
        $this->rolDescripcion = $rolDescripcion;

        return $this;
    }

    /**
     * Get rolDescripcion
     *
     * @return string
     */
    public function getRolDescripcion()
    {
        return $this->rolDescripcion;
    }

    public function __toString() {
        return strval($this->getIdRol()); }
}
