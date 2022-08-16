<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\Detallecomponente;
use App\Entity\Componente;

class componenteRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Componente::class);
    }

    public function getComponenteDetalle() {

        $dql = " SELECT dc.iddetallecomponente,concat(c.componente,' - ',dc.detallecomponente) as descripcionAll ";
        $dql .= ' FROM ' . Componente::class . ' c ';
        $dql .= ' inner JOIN ' . Detallecomponente::class . ' dc ';
        //$dql.= ' inner JOIN cd.descripcionComponenteDetalle as componenteCombo ';

        $consulta = $this->getEntityManager()->createQuery($dql);
        $array = $consulta->getResult();
/*        if (count($array) > 0) {
            foreach ($array as $itemComp) {

                $id = $itemComp['iddetallecomponente'];
                $arrayRta[$id] = $itemComp['descripcionAll'];
            }
        }*/
        return $consulta->getResult();

        //return $arrayRta;
    }

   

}
