<?php

namespace MDS\RuinstitucionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CargoAutoridad
 *
 * @ORM\Table(schema="mds_ruinstituciones", name="Cargo_Autoridad")
 * @ORM\Entity
 */
class CargoAutoridad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_aut_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cargoAutId;

    /**
     * @var integer
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false)
     */
    private $doctrineVersion = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_aut_desc", type="string", length=255, nullable=true)
     */
    private $cargoAutDesc;
    
    
    public function getCargoAutId() {
        return $this->cargoAutId;
    }

    public function getCargoAutDesc() {
        return $this->cargoAutDesc;
    }

    public function setCargoAutId($cargoAutId) {
        $this->cargoAutId = $cargoAutId;
    }

    public function setCargoAutDesc($cargoAutDesc) {
        $this->cargoAutDesc = $cargoAutDesc;
    }




}

