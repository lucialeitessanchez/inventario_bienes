<?php

namespace BienesBundle\Repository;

/**
 * ProveedorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProveedorRepository extends \Doctrine\ORM\EntityRepository
{
    public function _findAllOrderedByNombre()
{
    return $this->buildQuery()->orderBy('q.nombre', 'ASC');
}
}
