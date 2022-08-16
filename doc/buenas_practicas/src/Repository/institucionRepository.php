<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\ruinstituciones\ComisionDirectiva;
use App\Entity\ruinstituciones\AutoridadRui;
use App\Entity\ruinstituciones\CargoAutoridad;

class institucionRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Institucion::class);
    }

    public function getDatosInstitucion($idInstitucion) {

        //$dql = " SELECT i.instId,i.instNom,cd.comDirFecIni,cd.comDirFecFin,cd.comDirActiva,a.autApe,a.autNom,a.autDoc,cargo.cargoAutDesc";
        $dql = " SELECT i ";
        $dql .= ' FROM ' . Institucion::class . ' i ';
 //       $dql .= ' inner JOIN ' . ComisionDirectiva::class . ' cd ';
  //      $dql .= ' inner JOIN ' . AutoridadRui::class . ' a ';
   //     $dql .= ' inner JOIN ' . CargoAutoridad::class . ' cargo ';
       // $dql .= ' where i.instId=cd.institucion ';
     //   $dql .= ' and a.comisionDirectiva=cd.comDirId ';
      //  $dql .= ' and a.cargoAutoridad = cargo.cargoAutId ';
        $dql .= 'where (i.estadoReg!=3 or i.estadoReg is null) and i.instId=:idInstitucion';


        /* SELECT id_institucion,inst_nom,	com_dir_fec_ini,com_dir_fec_fin,com_dir_activa,aut_ape,aut_nom,aut_doc,cargo_aut_desc 
         * FROM `Institucion` 
         * inner join Comision_Directiva on inst_id=Comision_Directiva.institucion
         * inner join Autoridad on Autoridad.comision_directiva=Comision_Directiva.com_dir_id
         * inner join Cargo_Autoridad on Autoridad.cargo_autoridad = Cargo_Autoridad.cargo_aut_id
         * where Institucion.estado_reg!=3
         */
        $consulta = $this->getEntityManager()->createQuery($dql);
        $consulta->setParameter('idInstitucion', $idInstitucion);

        return $consulta->getResult();
    }
    
    public function getDatosComisionDirectiva($instId) {        
        
        
    
        $em = $this->getEntityManager();                
        $dql = ' SELECT c
                 FROM '.ComisionDirectiva::class.' c
                 WHERE c.comDirFecFin = (Select MAX(c1.comDirFecFin) 
                                         From '.ComisionDirectiva::class.' c1 
                                         Where c1.institucion = ?1 ) 
                       and c.institucion = ?1 '; 
                
        $query = $em->createQuery($dql)
                 ->setParameter(1, $instId);        
        $ormComDir = $query->getResult();   
        return $ormComDir;                
    }

}
