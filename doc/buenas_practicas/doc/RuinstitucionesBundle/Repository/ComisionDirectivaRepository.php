<?php

namespace MDS\RuinstitucionesBundle\Repository;

use Doctrine\ORM\EntityRepository;



class ComisionDirectivaRepository extends EntityRepository {
    
    /**
     * Funcion para obtener los datos de la Comision Directiva
     * de la Institucion se pasa como parametro.
     * Se busca la Comision Directiva con fecha mas actual (registro mas actual).
     * 
     * @param int $instId: id. institucion
     * @return array objeto ComisionDirectiva
     */
    public function getDatosComisionDirectiva($instId) {        
        
        
    
        $em = $this->getEntityManager();                
        $dql = ' SELECT c
                 FROM RuinstitucionesBundle:ComisionDirectiva c
                 WHERE c.comDirFecFin = (Select MAX(c1.comDirFecFin) 
                                         From RuinstitucionesBundle:ComisionDirectiva c1 
                                         Where c1.institucion = ?1 ) 
                       and c.institucion = ?1 '; 
                
        $query = $em->createQuery($dql)
                 ->setParameter(1, $instId);        
        $ormComDir = $query->getResult();   
        return $ormComDir;                
    }

        
} 
