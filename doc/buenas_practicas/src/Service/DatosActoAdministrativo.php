<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Actoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\Estadoactoadministrativo;
use App\Entity\Movimiento;
use App\Entity\Area;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
use App\Entity\ActoadministrativoHasCheckrequisitos;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DatosActoAdministrativo {

    private $em;

    function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

// -------------------------------------------------------------------
    public function getActosPorExpediente($nroexpediente) {


        $orm_actoadministrativos = $this->em->getRepository(Actoadministrativo::class)->findBy(array('nroexpediente' => $nroexpediente));

        $i = 0;
        $arr_result = array();

        foreach ($orm_actoadministrativos as $unacto) {
            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();
                //buscar ultimo estado
                $ult_estado = $this->em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $this->em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //busco ultima ubicacion
                $ult_movimiento = $this->em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {

                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                    $orm_area = $this->em->getRepository(Area::class)->find($idAreaDestino);
                    $ubicacion_actual = $orm_area->getArea();
                    $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                } else {
                    $ubicacion_actual = "Sin movimiemto";
                    $fecha_ubi = '';
                }
                //busco componentes
                $actoHasComponente = $this->em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $id));
                $componente_texto = array();
                $n = 0;
                foreach ($actoHasComponente as $detallecomponente) {
                    $orm_componente = $this->em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponentesolicitado());
                    $componente = $detallecomponente->getComponenteIdcomponentesolicitado()->getComponente();
                    $detallecomponente = $detallecomponente->getDetallecomponenteIddetallecomponentesolicitado()->getDetallecomponente();
                    $componente_texto[$n] = $detallecomponente . "-" . $componente;
                    $n++;
                }
                //busco archivos adjuntos
                $orm_archivos = $this->em->getRepository(Archivo::class)->findBy(array('actoadministrativoIdactoadministrativo' => $id));

                $arr_result[$i]['nroacto'] = $unacto->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = '';
                $arr_result[$i]['fechanota'] = '';
                $arr_result[$i]['fechamontoaprobado'] = '';
                $arr_result[$i]['nroexpediente'] = '';
                $arr_result[$i]['fechaexpediente'] = '';
                $arr_result[$i]['fechacaratula'] = '';
                $arr_result[$i]['fechadictamen'] = '';


                if ($unacto->getNronota())
                    $arr_result[$i]['nronota'] = $unacto->getNronota();
                if ($unacto->getFechanota())
                    $arr_result[$i]['fechanota'] = $unacto->getFechanota()->format("d-m-Y");
                if ($unacto->getNroexpediente())
                    $arr_result[$i]['nroexpediente'] = $unacto->getNroexpediente();
                if ($unacto->getFechaexpediente())
                    $arr_result[$i]['fechaexpediente'] = $unacto->getFechaexpediente()->format("d-m-Y");
                if ($unacto->getFechacaratula())
                    $arr_result[$i]['fechacaratula'] = $unacto->getFechacaratula()->format("d-m-Y");

                $arr_result[$i]['caratula'] = $unacto->getCaratula();

                if ($unacto->getFechadictamen())
                    $arr_result[$i]['fechadictamen'] = $unacto->getFechadictamen()->format("d-m-Y");

                $arr_result[$i]['observaciondictamen'] = $unacto->getObservaciondictamen();

                $arr_result[$i]['institucion'] = $unacto->getNombreinstitucion();
                $arr_result[$i]['nrosipaf'] = $unacto->getNrosipaf();
                $arr_result[$i]['localidad'] = $unacto->getLocalidadinst();
                $arr_result[$i]['departamento'] = $unacto->getDepartamentoinst();
                $arr_result[$i]['componente'] = $componente_texto;
                $arr_result[$i]['montosolicitado'] = $unacto->getMontosolicitado();
                $arr_result[$i]['montoaprobado'] = $unacto->getMontoaprobado();
                if ($unacto->getFechamontoaprobado())
                    $arr_result[$i]['fechamontoaprobado'] = $unacto->getFechamontoaprobado()->format("d-m-Y");
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['idestado_actual'] = $id_estado;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                $orm_areaCarga = $this->em->getRepository(Area::class)->find($unacto->getAreacarga());
                $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                $arr_result[$i]['adjuntos'] = $orm_archivos;

                $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                $i++;
            }
        }

        return $arr_result;
    }

// -------------------------------------------------------------------

    public function getActosPorNota($nroNota) {

        $orm_actoadministrativos = $this->em->getRepository(Actoadministrativo::class)->findBy(array('nronota' => $nroNota));

        $i = 0;
        $arr_result = array();

        foreach ($orm_actoadministrativos as $unacto) {
            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();
                //buscar ultimo estado
                $ult_estado = $this->em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $this->em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //busco ultima ubicacion
                $ult_movimiento = $this->em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {

                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                    $orm_area = $this->em->getRepository(Area::class)->find($idAreaDestino);
                    $ubicacion_actual = $orm_area->getArea();
                    $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                } else {
                    $ubicacion_actual = "Sin movimiemto";
                    $fecha_ubi = '';
                }
                $arr_result[$i]['nroacto'] = $unacto->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = '';
                $arr_result[$i]['fechanota'] = '';
                $arr_result[$i]['nroexpediente'] = '';
                if ($unacto->getNronota())
                    $arr_result[$i]['nronota'] = $unacto->getNronota();
                if ($unacto->getFechanota())
                    $arr_result[$i]['fechanota'] = $unacto->getFechanota()->format("d-m-Y");
                if ($unacto->getNroexpediente())
                    $arr_result[$i]['nroexpediente'] = $unacto->getNroexpediente();
                $arr_result[$i]['institucion'] = $unacto->getNombreinstitucion();
                $arr_result[$i]['nrosipaf'] = $unacto->getNrosipaf();
                $arr_result[$i]['localidad'] = $unacto->getLocalidadinst();
                $arr_result[$i]['departamento'] = $unacto->getDepartamentoinst();
                $arr_result[$i]['idestado_actual'] = $id_estado;
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                $orm_areaCarga = $this->em->getRepository(Area::class)->find($unacto->getAreacarga());
                $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                $i++;
            }
        }
        return $arr_result;
    }

    // -------------------------------------------------------------------

    public function getActoPorId($idActo) {

        $unacto = $this->em->getRepository(Actoadministrativo::class)->find($idActo);

        $i = 0;
        $arr_result = array();
        if ($unacto) {
            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();
                //buscar ultimo estado
                $ult_estado = $this->em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $this->em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //busco ultima ubicacion
                $ult_movimiento = $this->em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {

                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                    $orm_area = $this->em->getRepository(Area::class)->find($idAreaDestino);
                    $ubicacion_actual = $orm_area->getArea();
                    $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                } else {
                    $ubicacion_actual = "Sin movimiemto";
                    $fecha_ubi = '';
                }

                //busco componentes
                $actoHasComponente = $this->em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));
                $componente_texto = array();
                $n = 0;
                foreach ($actoHasComponente as $detallecomponente) {
                    $orm_componente = $this->em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponentesolicitado());
                    $componente = $detallecomponente->getComponenteIdcomponentesolicitado()->getComponente();
                    $detallecomponente = $detallecomponente->getDetallecomponenteIddetallecomponentesolicitado()->getDetallecomponente();
                    $componente_texto[$n] = $componente;
                    $n++;
                }
                //busco requisitos

                $listaRequisitos = $this->em->getRepository(ActoadministrativoHasCheckrequisitos::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));
                $requisitos_texto = ' -';
                foreach ($listaRequisitos as $requisito) {
                    $requisitos_texto .= $requisito->getCheckrequisitosIdcheckrequisitos()->getDetallerequisito() . " -";
                }
                //busco archivos adjuntos
                $orm_archivos = $this->em->getRepository(Archivo::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));

                $arr_result[$i]['nroacto'] = $unacto->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = '';
                $arr_result[$i]['fechanota'] = '';
                $arr_result[$i]['fechamontoaprobado'] = '';
                $arr_result[$i]['nroexpediente'] = '';
                $arr_result[$i]['fechaexpediente'] = '';
                $arr_result[$i]['fechacaratula'] = '';
                $arr_result[$i]['fechadictamen'] = '';
                if ($unacto->getNronota())
                    $arr_result[$i]['nronota'] = $unacto->getNronota();
                if ($unacto->getFechanota())
                    $arr_result[$i]['fechanota'] = $unacto->getFechanota()->format("d-m-Y");
                if ($unacto->getNroexpediente())
                    $arr_result[$i]['nroexpediente'] = $unacto->getNroexpediente();
                if ($unacto->getFechaexpediente())
                    $arr_result[$i]['fechaexpediente'] = $unacto->getFechaexpediente()->format("d-m-Y");
                if ($unacto->getFechacaratula())
                    $arr_result[$i]['fechacaratula'] = $unacto->getFechacaratula()->format("d-m-Y");

                $arr_result[$i]['caratula'] = $unacto->getCaratula();

                if ($unacto->getFechadictamen())
                    $arr_result[$i]['fechadictamen'] = $unacto->getFechadictamen()->format("d-m-Y");

                $arr_result[$i]['observaciondictamen'] = $unacto->getObservaciondictamen();

                $arr_result[$i]['institucion'] = $unacto->getNombreinstitucion();
                $arr_result[$i]['nrosipaf'] = $unacto->getNrosipaf();
                $arr_result[$i]['localidad'] = $unacto->getLocalidadinst();
                $arr_result[$i]['departamento'] = $unacto->getDepartamentoinst();
                $arr_result[$i]['referente'] = $unacto->getReferente();
                $arr_result[$i]['componente'] = $componente_texto;
                $arr_result[$i]['detalle_componente'] = $unacto->getObservacion();
                $arr_result[$i]['montosolicitado'] = $unacto->getMontosolicitado();
                $arr_result[$i]['montoaprobado'] = $unacto->getMontoaprobado();
                if ($unacto->getFechamontoaprobado())
                    $arr_result[$i]['fechamontoaprobado'] = $unacto->getFechamontoaprobado()->format("d-m-Y");
                $arr_result[$i]['requisitos'] = $requisitos_texto;
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['idestado_actual'] = $id_estado;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                $orm_areaCarga = $this->em->getRepository(Area::class)->find($unacto->getAreacarga());
                $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                if ($orm_archivos) {
                    //   $arr_result[$i]['adjuntos']=$orm_archivos;
                    $n = 0;
                    foreach ($orm_archivos as $item) {
                        $arr_result[$i]['adjuntos'][$n]['id'] = $item->getIdarchivo();
                        $arr_result[$i]['adjuntos'][$n]['tipo'] = $item->getTipoDocumentoIdTipodocumento()->getDescripciondocumento();
                        $arr_result[$i]['adjuntos'][$n]['nombrearchivo'] = $item->getNombrearchivo();
                        $arr_result[$i]['adjuntos'][$n]['path'] = $item->getPath();
                        $arr_result[$i]['adjuntos'][$n]['fechaupload'] = $item->getFechaupload()->format("d-m-Y");
                        $arr_result[$i]['adjuntos'][$n]['usuariocarga'] = $item->getUsuarioalta();

                        $n++;
                    }
                }

                $i++;
            }
        }
        return $arr_result;
    }

// -------------------------------------------------------------------

    public function getActosPorInstitucion($institucion) {



        $orm_actoadministrativos = $this->em->getRepository(Actoadministrativo::class)->findBy(array('nombreinstitucion' => $institucion));

        $i = 0;
        $arr_result = array();

        foreach ($orm_actoadministrativos as $unacto) {
            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();
                //buscar ultimo estado
                $ult_estado = $this->em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $this->em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //busco ultima ubicacion
                $ult_movimiento = $this->em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {

                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                    $orm_area = $this->em->getRepository(Area::class)->find($idAreaDestino);
                    $ubicacion_actual = $orm_area->getArea();
                    $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                } else {
                    $ubicacion_actual = "Sin movimiemto";
                    $fecha_ubi = '';
                }
                $arr_result[$i]['nroacto'] = $unacto->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = '';
                $arr_result[$i]['fechanota'] = '';
                $arr_result[$i]['nroexpediente'] = '';
                if ($unacto->getNronota())
                    $arr_result[$i]['nronota'] = $unacto->getNronota();
                if ($unacto->getFechanota())
                    $arr_result[$i]['fechanota'] = $unacto->getFechanota()->format("d-m-Y");
                if ($unacto->getNroexpediente())
                    $arr_result[$i]['nroexpediente'] = $unacto->getNroexpediente();
                $arr_result[$i]['institucion'] = $unacto->getNombreinstitucion();
                $arr_result[$i]['localidad'] = $unacto->getLocalidadinst();
                $arr_result[$i]['departamento'] = $unacto->getDepartamentoinst();
                $arr_result[$i]['idestado_actual'] = $id_estado;
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                $orm_areaCarga = $this->em->getRepository(Area::class)->find($unacto->getAreacarga());
                $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                $i++;
            }
        }
        return $arr_result;
    }

// -------------------------------------------------------------------
}
