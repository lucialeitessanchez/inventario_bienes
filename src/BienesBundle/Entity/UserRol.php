<?php

namespace BienesBundle\Entity;

/**
 * UserRol
 */
class UserRol
{
    /**
     * @var integer
     */
    private $userRolId;

    /**
     * @var \BienesBundle\Entity\Rol
     */
    private $rol;

    /**
     * @var \BienesBundle\Entity\User
     */
    private $user;


    /**
     * Get userRolId
     *
     * @return integer
     */
    public function getUserRolId()
    {
        return $this->userRolId;
    }

    /**
     * Set rol
     *
     * @param \BienesBundle\Entity\Rol $rol
     *
     * @return UserRol
     */
    public function setRol(\BienesBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \BienesBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set user
     *
     * @param \BienesBundle\Entity\User $user
     *
     * @return UserRol
     */
    public function setUser(\BienesBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BienesBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
