<?php

namespace BienesBundle\Entity;

/**
 * Rol
 */
class Rol
{
    /**
     * @var string
     */
    private $rolDescripcion;

    /**
     * @var string
     */
    private $idrol;


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

    /**
     * Get idrol
     *
     * @return string
     */
    public function getIdrol()
    {
        return $this->idrol;
    }
}
