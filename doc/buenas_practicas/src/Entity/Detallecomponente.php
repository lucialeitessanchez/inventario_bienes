<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detallecomponente
 *
 * @ORM\Table(name="detalleComponente", indexes={@ORM\Index(name="fk_detalleComponente_componente1_idx", columns={"componente_idComponente"})})
 * @ORM\Entity(repositoryClass="App\Repository\detallecomponenteRepository")
 */
class Detallecomponente extends DetallecomponenteBase {

    public function descripcionCombo() {
        //return $this->getIdDetalleComponente().$this->getDetallecomponente().$this->getComponenteIdcomponente()->getIdComponente().$this->getComponenteIdcomponente()->getComponente();
        return  $this->getComponenteIdcomponente()->getComponente()." - ".$this->getDetallecomponente();
    }

}
