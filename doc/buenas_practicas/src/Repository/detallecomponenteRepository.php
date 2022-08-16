<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\Detallecomponente;
use App\Entity\Componente;

class detallecomponenteRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Detallecomponente::class);
    }

    public function getComponenteDetalle($idcomponente) {

        $dql = ' SELECT dc.iddetallecomponente,dc.detallecomponente ';
        $dql .= ' FROM ' . Detallecomponente::class . ' dc ';
        $dql .= ' where dc.componenteIdcomponente=:idcomponente ';
        //$dql.= ' inner JOIN cd.descripcionComponenteDetalle as componenteCombo ';

        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('idcomponente', $idcomponente);

      //  $array = $consulta->getResult();
        /*if (count($array) > 0) {
            foreach ($array as $itemComp) {

                $id = $itemComp['iddetallecomponente'];
                $arrayRta[$id] = $itemComp['detallecomponente'];
            }
        }*/
        return $consulta->getResult();

        //return $arrayRta;
    }

}
