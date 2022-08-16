<?php

namespace MDS\RuinstitucionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Comision_Directiva
 *
 * @ORM\Table(schema="mds_ruinstituciones", name="Comision_Directiva" )
 * @ORM\Entity(repositoryClass="MDS\RuinstitucionesBundle\Repository\ComisionDirectivaRepository")
 */
class ComisionDirectiva{
	
	
	/**
        * @var integer
        *
        * @ORM\Column(name="com_dir_id", type="integer", nullable=false)
        * @ORM\Id
        * @ORM\GeneratedValue(strategy="IDENTITY")
        */
	protected $comDirId;
	
	/**
        * @var integer
        *
        * @ORM\Column(name="doctrine_version", type="integer", nullable=false)
        */
       private $doctrineVersion = '1';
	

	/**
        * @var \DateTime
        *
        * @ORM\Column(name="com_dir_fec_ini", type="date", nullable=true)
        */
	protected $comDirFecIni;
	
	/**
        * @var \DateTime
        *
        * @ORM\Column(name="com_dir_fec_fin", type="date", nullable=true)
        */
	protected $comDirFecFin;
	
	/**
         * 
	* @ORM\Column(name="`com_dir_activa`",type="boolean",nullable=true)
	*/
	protected $comDirActiva;        
	
        /**
         * 
         * @ORM\ManyToOne(targetEntity="Institucion")
         * @ORM\JoinColumns({
         *     @ORM\JoinColumn(name="institucion", referencedColumnName="inst_id")})
         */       
	protected $institucion;
        
        
        
        
        public function getComDirId() {
            return $this->comDirId;
        }

        public function getDoctrineVersion() {
            return $this->doctrineVersion;
        }

        public function getComDirFecIni(){
            return $this->comDirFecIni;
        }

        public function getComDirFecFin(){
            return $this->comDirFecFin;
        }

        public function getComDirActiva() {
            return $this->comDirActiva;
        }

        public function getInstitucion() {
            return $this->institucion;
        }

        public function setComDirId($comDirId) {
            $this->comDirId = $comDirId;
        }

        public function setDoctrineVersion($doctrineVersion) {
            $this->doctrineVersion = $doctrineVersion;
        }

        public function setComDirFecIni(\DateTime $comDirFecIni) {
            $this->comDirFecIni = $comDirFecIni;
        }

        public function setComDirFecFin(\DateTime $comDirFecFin) {
            $this->comDirFecFin = $comDirFecFin;
        }

        public function setComDirActiva($comDirActiva) {
            $this->comDirActiva = $comDirActiva;
        }

        public function setInstitucion($institucion) {
            $this->institucion = $institucion;
        }


	

}