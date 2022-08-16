<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\Actoadministrativo;

class actoAdministrativoRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Actoadministrativo::class);
    }

    public function getListaComponentesCargados($idacto) {
        /*
          $dql = ' SELECT a,c ';
          $dql .= ' FROM ' . Actoadministrativo::class . ' a ';
          $dql .= ' left JOIN c.listaComponentes as c';
          $dql .= ' WHERE a.actoadministrativoIdactoadministrativo=:idacto';

          $consulta = $this->getEntityManager()->createQuery($dql);
          $consulta->setParameter('idacto', idacto);
         */
        $dql = ' SELECT tc,tcp ';
        $dql .= ' FROM ' . Actoadministrativo::class . ' tc ';
        $dql .= ' left JOIN tc.listaComponentes as tcp ';
        $dql .= ' WHERE tc.actoadministrativoIdactoadministrativo=:idacto';

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('idacto', $idacto);
        return $consulta->getResult();
    }

    //-------------------------------------------------------------------------

  
}
