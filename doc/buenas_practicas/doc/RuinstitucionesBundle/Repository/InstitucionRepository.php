<?php

namespace MDS\RuinstitucionesBundle\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;



class InstitucionRepository extends EntityRepository {
    
    /**
     * Funcion para obtener array objetos Institucion
     * para la localidad pasada como parametro, y que no esten ANULADAS (estado_reg = 3)
     * 
     * @param int $locId: id.localidad
     * @return array objetos Institucion
     */
    public function getInstitucionesXLocalidad($locId, $destinatarioONG = '') {        
        
        $em = $this->getEntityManager();
        
        $dql = ' SELECT i
                 FROM RuinstitucionesBundle:Institucion i
                 WHERE i.localidad = ?1 AND i.estadoReg != ?2 ';
        if ($destinatarioONG == 6)
            $dql .= ' AND i.instNroRong IS NOT NULL ';
        $dql .= ' ORDER BY i.instNom ASC ';
            
        $query = $em->createQuery($dql)
                ->setParameter(1, $locId)
                ->setParameter(2, 3);        
        
        $arrRtdo = $query->getResult();
        
        return $arrRtdo;                
    }

    // ======================================================================
    // ======================================================================
    
    
    /**
     * Para una Institucion verifico:
     * 1- Que tenga fecha de certificado de subsistencia vigente (1 año) - campo inst_nro_rong_fec
     * 2- Que exista Comision Directiva y que su fecha de vigencia no este vencida.
     * 
     * @param int $instId
     * @return string
     */
    public function checkInstitucionOng($instId) {

        $error = '';
        
        $em = $this->getEntityManager();
        $ormOng = $em->getRepository('RuinstitucionesBundle:Institucion')->findOneBy(array('instId' => $instId));

        // -- Es una Institucion de tipo ONG         
        if ($ormOng) {            
            
//            if (!$ormOng->getOrgNroOng())
//                $error = 'La Institucion seleccionada no está registrada en REGISTRO ONG. Verifique.';

            // --------------------------------------------------
            // -- Controlo fecha del Certificado de Subsistencia, si esta registrada o no.
            $datetime1 = $ormOng->getInstNroRongFec();
            if (!$datetime1)
                $error = 'La Institución -ONG- no tiene registrada la Fecha del Certificado de Subsistencia. Verifique.';
            else {
                // --------------------------------------------------
                // -- Controlo fecha de Certificado que esté vigente, duración 1 año.
                $fechaHoy = new \DateTime('now');
                $interval = $datetime1->diff($fechaHoy);
                if ($interval->format('%a días') > 365)
                    $error = 'La Fecha del Certificado de Subsistencia de la ONG ha caducado. Verifique.';
            }
        
            // ------------------------------------------------------
            // -- Controlo Comision Directiva - fecha de vigencia            
//            $dql = ' SELECT c
//                     FROM RuinstitucionesBundle:ComisionDirectiva c
//                     WHERE c.comDirFecFin = (Select MAX(c1.comDirFecFin) 
//                                             From RuinstitucionesBundle:ComisionDirectiva c1 
//                                             Where c1.institucion = :data ) and c.institucion = :data ';            
//            
//            $query = $em->createQuery($dql)
//                    ->setParameter('data', $ormOng->getInstId());
//            $ormComDir = $query->getResult();   
            $ormComDir = $em->getRepository('RuinstitucionesBundle:ComisionDirectiva')->getDatosComisionDirectiva($ormOng->getInstId());            
            if (count($ormComDir) > 0){
                
                $fecha_ini = $ormComDir[0]->getComDirFecIni();
                $fecha_fin = $ormComDir[0]->getComDirFecFin();                
                
                if(($fecha_ini == NULL) || ($fecha_fin == NULL))
                    $error = 'La Comisión Directiva no tiene registrada su fecha de vigencia. Verifique.';

                $fechaHoy = new \DateTime('now');                
                $fecha_fin = $fecha_fin->format('Y-m-d');                        
                $fechaComDir = \DateTime::createFromFormat('Y-m-d', $fecha_fin);

                if ($fechaComDir < $fechaHoy)
                    $error = 'La Comisión Directiva tiene fecha de vigencia vencida. Verifique.';
            }
            else
                $error = 'No existe Comisión Directiva registrada. Verifique.';
        }        
        
        return $error;
    }
    
    
    // =====================================================================
    
    /**
     * Funcion que devuelve datos de la Institucion, cuando es de tipo ONG (id: 6)
     * 
     * @param int $instId: id. institucion para obtener sus datos.
     * @return array $rta: array con los datos
     *          ['nombreInst']
     *          ['nroOng']
     *          ['direccion']
     *          ['ormComDir']: array
     *                      ['fecha_inicio']
     *                      ['fecha_fin']
     *                      ['autoCom']: array
     *                                  ['ape_nom']
     *                                  ['documento']
     *                                  ['cargo']
     * 
     */
    public function getDatosOng($instId) {
        
        
        $rta = array();
        $em = $this->getEntityManager();
        
        $ormInst = $em->getRepository('RuinstitucionesBundle:Institucion')->find($instId); 
        if ($ormInst)       
	    $rta['nombreInst'] = strtoupper($ormInst->getInstNom());        
        else
            $rta['nombreInst'] = '';

//        $ormOng = $em->getRepository('RegOngBundle:Organizacion')->findOneBy(array('institucion' => $instId));
//        if (!$ormOng){
//            $rta['nroOng'] = '';
//            $rta['direccion'] = '';  
//            $rta['ormComDir'] = '';
//        }
//        else{           
       
        $rta['nroOng'] = '';
        $rta['direccion'] = '';  
        $rta['ormComDir'] = '';                
        if ($ormInst->getInstNroRong())
            $rta['nroOng'] = $ormInst->getInstNroRong();
        
        $rta['direccion'] = $ormInst->getInstDirCalle()." ".$ormInst->getInstDirNro()." ".$ormInst->getDetalleDomicilio();
        
        // -- Comision Directiva        
//        $dql = ' SELECT c
//                 FROM RegOngBundle:ComDir c
//                 WHERE c.comFecFin = (Select MAX(c1.comFecFin) 
//                                      From RegOngBundle:ComDir c1 
//                                      Where c1.organizacion = :data ) and c.organizacion = :data ';        
//        
//            $query = $em->createQuery($dql)
//                        ->setParameter('data', $ormOng->getOrgId());
//            $ormComDir = $query->getResult();  
            
            $ormComDir = $em->getRepository('RuinstitucionesBundle:ComisionDirectiva')->getDatosComisionDirectiva($ormInst->getInstId());
            if (count($ormComDir) == 0 ){
 		$rta['ormComDir'] = '';
            }
	    else{              

		$comDir = $ormComDir[0];
		$fecha_ini = $comDir->getComDirFecIni()->format('d-m-Y');
		$fecha_fin = $comDir->getComDirFecFin()->format('d-m-Y');                       
		$rta['ormComDir'] = array('fecha_inicio' => $fecha_ini, 'fecha_fin' => $fecha_fin, 'autoCom' => '');
		
		// -- Autoridades Comision Directiva
		$arrAutoCom = $em->getRepository('RuinstitucionesBundle:Autoridad')->findBy(array('comisionDirectiva' => $comDir->getComDirId()));
                
		$arr_autoridades = array();
		if (count($arrAutoCom) > 0){            
                    $i = 0;
                    foreach($arrAutoCom as $auto){
                        
                        $idAutoridad = $auto->getAutId();
                        $cargoDes = $auto->getCargoAutoridad()->getCargoAutDesc();                        
                        if($cargoDes)
                            $strCargo = strtoupper($cargoDes);
                        else
                            $strCargo = ' -- ';
                        
                        $arr_autoridades[$i]['ape_nom'] = $auto->getAutApe()." ".$auto->getAutNom();
	                $arr_autoridades[$i]['documento'] = $auto->getAutDoc();
	                $arr_autoridades[$i]['cargo'] = $strCargo;
	                $i++;
                     
                     
//		     // -- obtengo orm Autoridad
//                     $idAutoridad = $auto->getAutoridades();   
//		     $ormAuto = $em->getRepository('RegOngBundle:Autoridades')->findOneBy(array('autInstId' => $idAutoridad));
//		     if ($ormAuto && (!$ormAuto->getAutInstFbaja())){
//		        // -- obtengo orm Cargo, de la autoridad
//		        $ormCargo = $em->getRepository('RegOngBundle:TipoCargo')->findOneBy(array('tipCarId' => $ormAuto->getTipoCargo()));
//	                if ($ormCargo)
//	                    $strCargo = strtoupper($ormCargo->getTipCarDes());
//	                else
//	                    $strCargo = ' -- ';
//		            
//	                 $arr_autoridades[$i]['ape_nom'] = $auto->getAutApe()." ".$auto->getAutNom();
//	                 $arr_autoridades[$i]['documento'] = $auto->getAutDoc();
//	                 $arr_autoridades[$i]['cargo'] = $strCargo;
//	                 $i++;
                    }                
                }
                
                $rta['ormComDir']['autoCom'] = $arr_autoridades;            
            }		               
            
//        }
        return $rta;
        
    }    
    
} 
