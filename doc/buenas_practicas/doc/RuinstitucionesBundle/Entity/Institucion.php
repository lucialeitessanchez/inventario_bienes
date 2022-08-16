<?php

namespace MDS\RuinstitucionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institucion
 *
 * @ORM\Table(schema="mds_ruinstituciones", name="Institucion")
 * @ORM\Entity(repositoryClass="MDS\RuinstitucionesBundle\Repository\InstitucionRepository")
 */
class Institucion extends InstitucionBase
{

    public function getDetalleDomicilio(){
        
        $strDetalle = " ";
        if ($this->getInstDirPiso())
            $strDetalle .= "Piso: ".$this->getInstDirPiso()." ";
        
        if ($this->getInstDirDptoOfiCasa())
            $strDetalle .= $this->getInstDirPiso()." ";
        
        if ($this->getInstDirManz())
            $strDetalle .= "Manzana: ".$this->getInstDirManz()." ";
        
        if ($this->getInstDirTorreMonob())
            $strDetalle .= $this->getInstDirTorreMonob()." ";
        
        if ($this->getInstDirTorreMonob())
            $strDetalle .= $this->getInstDirTorreMonob()." ";
        
        if ($this->getInstDirEscPasillo())
            $strDetalle .= $this->getInstDirEscPasillo()." ";
        
        if ($this->getInstDirEscPasilloNro())
            $strDetalle .= $this->getInstDirEscPasilloNro()." ";
        
        if ($this->getInstDirVecAsent())
            $strDetalle .= $this->getInstDirVecAsent()." ";
        
        if ($this->getInstDirVecAsentNro())
            $strDetalle .= $this->getInstDirVecAsentNro()." ";
        
        if ($this->getInstDirRuta())
            $strDetalle .= "Ruta: ".$this->getInstDirRuta()." ";
        
        if ($this->getInstDirRutaKm())
            $strDetalle .= "Km: ".$this->getInstDirRutaKm()." ";
        
        if ($this->getInstDirRefVisGeo())
            $strDetalle .= "Ref.: ".$this->getInstDirRefVisGeo()." ";
        
        return $strDetalle;        
        
    }

    


}

