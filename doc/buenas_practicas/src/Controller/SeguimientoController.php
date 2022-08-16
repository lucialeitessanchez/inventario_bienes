<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\seguimientoActoType;
use App\Form\ingresoActoType;
use App\Form\modificarActoType;
use App\Form\datosActoType;
use App\Entity\Actoadministrativo;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\tablascomunes\TLoc;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\Estadoactoadministrativo;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Checkrequisitos;
use App\Entity\ActoadministrativoHasCheckrequisitos;
use App\Entity\Movimiento;
use App\Entity\Area;
use App\Entity\ObservacionesBp;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
use App\Report\Reportes;
use App\Service\DatosActoAdministrativo;
use App\Service\ConsultaSie;
use App\Service\IOINPUT;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @Route(path="/seguimiento")
 */
class SeguimientoController extends AbstractController {

    /**
     * @Route(path="/seguimientoActo", name="seguimiento_actoAdministrativo")
     */
    public function SeguimientoActoAction(Request $request, PaginatorInterface $paginator) {

        $session = $request->getSession();

       // $arr_result = array();
        //$arr_result_filtro = array();
        //$arr_result_rango = array();
        $institucion = '';
        $idActoFiltra = '';

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $seguimiento = new Actoadministrativo();
        $form = $this->createForm(seguimientoActoType::class, $seguimiento, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');
        //$idestadoBuscar = $request->request->get('idestadobuscar');
        $idestadoBuscar = $form['filtrarEstado']->getData();
        $arr_result = $this->getAllActos($idestadoBuscar);

        rsort($arr_result);


        // Paginate the results of the query
        $paginador = $paginator->paginate(
                // Doctrine Query, not results
                $arr_result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                10
        );
        if ($form->isSubmitted()) {
            if ($form->get('filtrarLista')->isClicked() || $form['filtrar']->getData()) {
                $arr_result_filtro = array();
                $arr_result = array();
                $arr_result_rango = array();
                $institucion = '';

                $idActoFiltra = $request->request->get('idActoAdministrativo_filtra');
                $nroexpediente = $form['filtrarExpediente']->getData();
                $nronota = $request->request->get('nroNota_filtra');

                $fdesde = $form['fechaDesde']->getData();
                $fhasta = $form['fechaHasta']->getData();


                if ($form['nombreinstitucion']->getData())
                    $institucion = $form['nombreinstitucion']->getData()->getNombreinstitucion();


                $datosActo = new DatosActoAdministrativo($em);

                if ($nroexpediente && (!$idActoFiltra && !$nronota && !$institucion)) { //filtra por nro de expediente
                    //$arr_result = $datosActo->getActosPorExpediente($nroexpediente);
                    $arr_result_filtro = $datosActo->getActosPorExpediente($nroexpediente);
                    //veo si ademas puso fecha
                    if ($fdesde && $fhasta) {

                        $x = 0;
                        for ($i = 0; $i < count($arr_result_filtro); $i++) {

                            $fechacompara = new \DateTime($arr_result_filtro[$i]['fechacarga']);

                            if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                                //   if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                                $arr_result_rango[$x] = $arr_result_filtro[$i];
                                $x++;
                            }
                        }
                        if ($arr_result_rango)
                            $arr_result_filtro = $arr_result_rango;
                    }
                    //die();
                    if ($form['filtrar']->getData()) {
                        $idestadoBuscar = $form['filtrarEstado']->getData();

                        if ($idestadoBuscar) {//si ademas busca un estado en particular
                            $x = 0;
                            for ($i = 0; $i < count($arr_result_filtro); $i++) {
                                $idestadoactual = $arr_result_filtro[$i]['idestado_actual'];
                                if ($arr_result_filtro[$i]['idestado_actual'] != $idestadoBuscar)
                                    continue;
                                $arr_result[$x] = $arr_result_filtro[$i];
                                $x++;
                            }
                        } else {
                            $arr_result = $arr_result_filtro;
                        }
                    }
                }
                if ($nronota && (!$nroexpediente && !$idActoFiltra && !$institucion)) { //filtra por nroNota
                    $arr_result = $datosActo->getActosPorNota($nronota);
                }
                if ($idActoFiltra && (!$nroexpediente && !$nronota && !$institucion)) { //filtra por idacto
                    $arr_result = $datosActo->getActoPorId($idActoFiltra);
                }

                if ($institucion && (!$nroexpediente && !$nronota && !$idActoFiltra)) { //filtra por nombreinstitucion
                    $arr_result_filtro = $datosActo->getActosPorInstitucion($institucion);


                    if ($fdesde && $fhasta) {

                        $x = 0;
                        for ($i = 0; $i < count($arr_result_filtro); $i++) {

                            $fechacompara = new \DateTime($arr_result_filtro[$i]['fechacarga']);

                            if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                                //   if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                                $arr_result_rango[$x] = $arr_result_filtro[$i];
                                $x++;
                            }
                        }
                        if ($arr_result_rango)
                            $arr_result_filtro = $arr_result_rango;
                    }

                    if ($form['filtrar']->getData()) {
                        $idestadoBuscar = $form['filtrarEstado']->getData();

                        if ($idestadoBuscar) {//si ademas busca un estado en particular
                            $x = 0;
                            for ($i = 0; $i < count($arr_result_filtro); $i++) {
                                $idestadoactual = $arr_result_filtro[$i]['idestado_actual'];
                                if ($arr_result_filtro[$i]['idestado_actual'] != $idestadoBuscar)
                                    continue;
                                $arr_result[$x] = $arr_result_filtro[$i];
                                $x++;
                            }
                        } else {
                            $arr_result = $arr_result_filtro;
                        }
                    }
                }

                if ($fdesde && $fhasta && (!$institucion && !$nroexpediente && !$nronota && !$idActoFiltra)) {

                    $arr_result_filtro = $this->getAllActos();

                    $x = 0;
                    for ($i = 0; $i < count($arr_result_filtro); $i++) {

                        $fechacompara = new \DateTime($arr_result_filtro[$i]['fechacarga']);

                        if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                            //   if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                            $arr_result_rango[$x] = $arr_result_filtro[$i];
                            $x++;
                        }
                    }
                    if ($arr_result_rango)
                        $arr_result_filtro = $arr_result_rango;
                //}


                if ($form['filtrar']->getData()) {
                    $idestadoBuscar = $form['filtrarEstado']->getData();

                    if ($idestadoBuscar) {//si ademas busca un estado en particular
                        $x = 0;
                        for ($i = 0; $i < count($arr_result_filtro); $i++) {
                            $idestadoactual = $arr_result_filtro[$i]['idestado_actual'];
                            if ($arr_result_filtro[$i]['idestado_actual'] != $idestadoBuscar)
                                continue;
                            $arr_result[$x] = $arr_result_filtro[$i];
                            $x++;
                        }
                    } else {
                        $arr_result = $arr_result_filtro;
                    }
                }
            }


            rsort($arr_result);

            // Paginate the results of the query
            $paginador = $paginator->paginate(
                    // Doctrine Query, not results
                    $arr_result,
                    // Define the page parameter
                    $request->query->getInt('page', 1),
                    // Items per page
                    10
            );
        }
        if ($form->get('imprimir')->isClicked()) {
            $pdf = new Reportes('L');
            $pdf->printReport_SeguimientoActo($arr_result);
            // limpiar el buffer de datos
            ob_end_clean();
            $pdf->Output("seguimientoActo.pdf", 'I');
        }

        return $this->render('seguimientoActo.html.twig', array('form' => $form->createView(), 'array_result' => $paginador, 'totreg' => count($arr_result), 'idactoadministrativo' => '', 'institucion' => $institucion, 'idactoadministrativo_filtra' => $idActoFiltra));
        }
        return $this->render('seguimientoActo.html.twig', array('form' => $form->createView(), 'array_result' => $paginador, 'totreg' => count($arr_result), 'idactoadministrativo' => '', 'institucion' => '', 'idactoadministrativo_filtra' => ''));
    }

// -------------------------------------------------------------------     

    /**
     * @Route(path="/verActo/{idactoadministrativo}", name="ver_acto")
     */
    public function VerActoAction($idactoadministrativo) {


        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $seguimiento = new Actoadministrativo();
        $form = $this->createForm(seguimientoActoType::class, $seguimiento, array('em' => $em, 'em_instituciones' => $em_instituciones));

        if ($idactoadministrativo) {



            $array_observaciones = array();
            $array_adjuntos = array();
            $array_datos = array();

            $componente_texto = '';
            $i = 0;
            $ingreso = $em->getRepository(Actoadministrativo::class)->find($idactoadministrativo);

            //buscar area de carga
            $orm_areaCarga = $em->getRepository(Area::class)->find($ingreso->getAreacarga());
            $area_carga = $orm_areaCarga->getArea();
            //buscar ultimo estado
            $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo), array('fechacarga' => 'desc'));

            $orm_estado = $em->getRepository(\App\Entity\Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
            $id_estado = $orm_estado->getIdestado();
            $estado_desc = $orm_estado->getEstadodescripcion();

            //buscar localidad
            $orm_loc = $em->getRepository(TLoc::class)->find($ingreso->getIdlocalidadinst());
            $localidadInst = $orm_loc->getLoc();
            $localidad = $orm_loc->getIdLoc();

            //buscar institucion
            $orm_institucion = $em_instituciones->getRepository(Institucion::class)->find($ingreso->getInstId());
            $instId = $orm_institucion->getInstId();
            $nombreInst = $orm_institucion->getInstNom();

            //buscar componentes
            $actoHasComponente = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
            foreach ($actoHasComponente as $detallecomponente) {
                $orm_componente = $em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponentesolicitado());
                $componente = $detallecomponente->getComponenteIdcomponentesolicitado()->getComponente();
                $detallecomponente = $detallecomponente->getDetallecomponenteIddetallecomponentesolicitado()->getDetallecomponente();
                $componente_texto .= $detallecomponente . "-" . $componente;
                if (count($actoHasComponente) > 1)
                    $componente_texto .= ", ";
                }

                //observaciones del proyecto (entidad ObservacionesBp
                $array_observaciones = $em->getRepository(ObservacionesBp::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo), array('fechacarga' => 'asc'));

                //buscarchekrequisitos
                $listaRequisitos = $em->getRepository(ActoadministrativoHasCheckrequisitos::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
                $requisitos_texto = ' -';
                foreach ($listaRequisitos as $requisito) {
                    $requisitos_texto .= $requisito->getCheckrequisitosIdcheckrequisitos()->getDetallerequisito() . " -";
                }
                //busco adjuntos
                $orm_archivos = $em->getRepository(Archivo::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
                if ($orm_archivos) {
                    //   $arr_result[$i]['adjuntos']=$orm_archivos;
                    $n = 0;
                    foreach ($orm_archivos as $item) {
                        $array_adjuntos[$n]['id'] = $item->getIdarchivo();
                        $array_adjuntos[$n]['tipo'] = $item->getTipoDocumentoIdTipodocumento()->getDescripciondocumento();
                        $array_adjuntos[$n]['nombrearchivo'] = $item->getNombrearchivo();
                        $array_adjuntos[$n]['path'] = $item->getPath();
                        $array_adjuntos[$n]['fechaupload'] = $item->getFechaupload()->format("d-m-Y");
                        $array_adjuntos[$n]['usuariocarga'] = $item->getUsuarioalta();
                        $n++;
                    }
                }
                $fechaExpediente = $ingreso->getFechaExpediente();

//***************FIN DATOS COMPLETOS******************************************

                if (($id_estado == 1 || $id_estado == 2 || $id_estado == 3 || $id_estado == 4 || $id_estado == 12) && ($area == 1 || $area == 5)) {//Iniciado - aprobado a la espera - no aprobado - tramitado por otro programa
                    $form_acto = $this->createForm(modificarActoType::class, $ingreso, array('em' => $em, 'em_instituciones' => $em_instituciones));
                    return $this->render('modificarActo.html.twig', array('form' => $form_acto->createView(), 'idactoadministrativo' => $idactoadministrativo, 'array_observaciones' => $array_observaciones, 'instId' => $orm_institucion, 'localidad' => $orm_loc, 'estado' => $estado_desc, 'areacarga' => $area_carga, 'array_adjuntos' => $array_adjuntos));
                }

                if ($id_estado == 2 && $area == 2) {//Aprobado en curso ->adjunta informe social
                    $array_datos[$i]['acto'] = $ingreso;
                    $array_datos[$i]['institucion'] = $orm_institucion;
                    $array_datos[$i]['componente'] = $componente_texto;
                    $array_datos[$i]['documentacion'] = $requisitos_texto;
                    $array_datos[$i]['estado_actual'] = $estado_desc;

                    $form_acto_UE = $this->createForm(datosActoType::class, $ingreso, array('em' => $em, 'em_instituciones' => $em_instituciones));

                    return $this->render('datosActo.html.twig', array('form' => $form_acto_UE->createView(), 'area' => $area, 'array_observaciones' => $array_observaciones, 'array_datos' => $array_datos, 'observacionbp' => '', 'idactoadministrativo' => $idactoadministrativo, 'estado' => $estado_desc, 'idestadoActual' => $id_estado, 'array_adjuntos' => $array_adjuntos));
                }
                if (($id_estado == 2 || $id_estado == 3 || $id_estado == 6 || $id_estado == 7 || $id_estado == 8 || $id_estado == 9 || $id_estado == 10 || $id_estado == 11 || $id_estado == 12 ) || (($id_estado == 1 && ($area != 1 || $area != 5)) )) {//para dictaminar -gestionar firma - gestion de pago-pagado - rendido
                    $array_datos[$i]['acto'] = $ingreso;
                    $array_datos[$i]['institucion'] = $orm_institucion;
                    $array_datos[$i]['componente'] = $componente_texto;
                    $array_datos[$i]['documentacion'] = $requisitos_texto;
                    $array_datos[$i]['estado_actual'] = $estado_desc;


                    $form_acto_datos = $this->createForm(datosActoType::class, $ingreso, array('em' => $em, 'em_instituciones' => $em_instituciones));
                    //si el area es CONVENIO (area3) no modifica estado --> si es 7 lo va a modificar por movimiento cuando lo pase a gestion de pago(8)
                    //si el area es DPRINST (area5) modifica estado a pagado(9) o rendido(10)
                    //ambas areas agregan observaciones

                    return $this->render('datosActo.html.twig', array('form' => $form_acto_datos->createView(), 'area' => $area, 'array_observaciones' => $array_observaciones, 'array_datos' => $array_datos, 'observacionbp' => '', 'idactoadministrativo' => $idactoadministrativo, 'estado' => $estado_desc, 'idestadoActual' => $id_estado, 'array_adjuntos' => $array_adjuntos));
                }
                }

                return $this->render('seguimientoActo.html.twig', array('form' => $form->createView(), 'array_result' => '', 'idactoadministrativo' => '', 'institucion' => ''));
            }

// ------------------------------------------------------------------- 

            /**
             * @Route(path="/guardar_UE/{idactoadministrativo}", name="guardarUE")
             */
            public function guardarUEAction(Request $request, $idactoadministrativo) { //guarda datos que carga la UE
                $session = $request->getSession();

                $em = $this->getDoctrine()->getManager('default');
                $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');
                $area = $this->getUser()->getOficinas();
                $usuariocarga = $this->getUser()->getUsername();

                $seguimiento = $em->getRepository(Actoadministrativo::class)->find($idactoadministrativo);

                $form = $this->createForm(seguimientoActoType::class, $seguimiento, array('em' => $em, 'em_instituciones' => $em_instituciones));
                $form->handleRequest($request);
                $data = $request->request->get('form');

                $componente_texto = '';
                $array_datos = array();
                $listaComponentes = array();
                $array_observaciones = array();
                $i = 0;

                //buscar ultimo estado
                $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo), array('fechacarga' => 'desc'));

                $orm_estado = $em->getRepository(\App\Entity\Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //buscar localidad
                $orm_loc = $em->getRepository(TLoc::class)->find($seguimiento->getIdlocalidadinst());
                $localidadInst = $orm_loc->getLoc();
                $localidad = $orm_loc->getIdLoc();

//buscar institucion
                $orm_institucion = $em_instituciones->getRepository(Institucion::class)->find($seguimiento->getInstId());
                $instId = $orm_institucion->getInstId();
                $nombreInst = $orm_institucion->getInstNom();


                $seguimiento_up = $em->getRepository(Actoadministrativo::class)->find($idactoadministrativo);
                $seguimiento_up->setCbuinstitucion($form['cbuinstitucion']->getData());
                $seguimiento_up->setFechamontoaprobado($form['fechamontoaprobado']->getData());


//guardo componentes seleccionados
                $listaComponentes = $form['detallecomponenteIddetallecomponentesolicitado']->getData();
//antes borro lo que habia
                $actoHasComponente_borrar = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
                if (!empty($actoHasComponente_borrar)) {
                    foreach ($actoHasComponente_borrar as $detallecomponente) {
                        $em->remove($detallecomponente);
                        $em->flush();
                    }
                }

                foreach ($listaComponentes as $detallecomponente) {
                    $orm_componente = $em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponente());

                    $actoHasComponente = new ActoadministrativoHasComponente();
                    $actoHasComponente->setActoadministrativoIdactoadministrativo($seguimiento_up);
                    $actoHasComponente->setComponenteIdcomponentesolicitado($orm_componente);
                    $actoHasComponente->setDetallecomponenteIddetallecomponentesolicitado($detallecomponente);
                    $actoHasComponente->setFechaaprobado($form['fechamontoaprobado']->getData());
                    $em->persist($actoHasComponente);
                }

                $listaRequisitos = array();
                $listaRequisitos_old = array();
//guardo requisitos
                $listaRequisitos = $form['detallerequisito']->getData();

                if ($form['detallerequisito']->getData()) {

                    //primero borro lo que esta
                    $listaRequisitos_old = $em->getRepository(ActoadministrativoHasCheckrequisitos::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
                    if ($listaRequisitos_old) {

                        foreach ($listaRequisitos_old as $requisito_old) {

                            $orm_requisitos_delete = $em->getRepository(ActoadministrativoHasCheckrequisitos::class)->find($requisito_old);
                            $em->remove($orm_requisitos_delete);
                            $em->flush();
                        }
                    }
//guardo los nuevos
                    foreach ($listaRequisitos as $requisito) {
                        $orm_requisitos = $em->getRepository(Checkrequisitos::class)->find($requisito);

                        $actoHascheck = new ActoadministrativoHasCheckrequisitos();
                        $actoHascheck->setActoadministrativoIdactoadministrativo($seguimiento_up);
                        $actoHascheck->setCheckrequisitosIdcheckrequisitos($orm_requisitos);
                        $actoHascheck->setFechacarga(new \DateTime());

                        $em->persist($actoHascheck);
                    }
                    }
                    //guardo observacionesBP
                    if ($form['observacionbp']->getData()) {
                        $orm_observacionesBp = new ObservacionesBp();
                        $orm_observacionesBp->setActoadministrativoIdactoadministrativo($seguimiento_up);
                        $orm_observacionesBp->setObservacion($form['observacionbp']->getData());
                        $orm_observacionesBp->setFechaobs(new \DateTime());
                        $orm_observacionesBp->setFechacarga(new \DateTime());
                        $orm_observacionesBp->setUsuario($usuariocarga);
                        $em->persist($orm_observacionesBp);
                    }

                    $em->persist($seguimiento_up);
                    $em->flush();

                    $actoHasComponente = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
                    foreach ($actoHasComponente as $detallecomponente) {
                        $orm_componente = $em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponentesolicitado());
                        $componente = $detallecomponente->getComponenteIdcomponentesolicitado()->getComponente();
                        $detallecomponente = $detallecomponente->getDetallecomponenteIddetallecomponentesolicitado()->getDetallecomponente();
                        $componente_texto .= $detallecomponente . "-" . $componente;
                        if (count($actoHasComponente) > 1)
                            $componente_texto .= ", ";
                    }
                    $array_observaciones = $em->getRepository(ObservacionesBp::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo), array('fechacarga' => 'asc'));

                    $array_datos[$i]['acto'] = $seguimiento;
                    $array_datos[$i]['institucion'] = $orm_institucion;
                    $array_datos[$i]['componente'] = $componente_texto;
                    $array_datos[$i]['estado_actual'] = $estado_desc;

                    $mensaje_txt = 'Se ACTUALIZARON los datos correctamente';
                    $session->getFlashBag()->add('aviso', $mensaje_txt);
                    return $this->render('2_seguimientoActo.html.twig', array('form' => $form->createView(), 'array_datos' => $array_datos, 'array_observaciones' => $array_observaciones, 'idactoadministrativo' => $idactoadministrativo));
                }

// ------------------------------------------------------------------- 

                /**
                 * @Route(path="/listaComponentes/{idactoadministrativo}", name="get_lista_componentesAprobados")
                 */
                function getListaComponentesAction($idactoadministrativo) {

                    $em = $this->getDoctrine()->getManager('default');
                    $listaComponentes = array();
                    $i = 0;

                    $orm_actoadministrativoHasComponente = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));

                    if (!empty($orm_actoadministrativoHasComponente)) {
                        foreach ($orm_actoadministrativoHasComponente as $componentes) {
                            $listaComponentes[$i] = $componentes->getDetallecomponenteIddetallecomponente()->getIddetallecomponente();
                            $i++;
                        }
                    }

                    return new JsonResponse($listaComponentes);
                }

// ------------------------------------------------------------------- 

                /**
                 * @Route(path="/listaRequisitos/{idactoadministrativo}", name="get_check_requisitos")
                 */
                function getRequisitosAction($idactoadministrativo) {

                    $em = $this->getDoctrine()->getManager('default');
                    $listaRequisitos = array();
                    $i = 0;

                    $orm_actoadministrativoHasCheckrequisitos = $em->getRepository(ActoadministrativoHasCheckrequisitos::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));

                    if (!empty($orm_actoadministrativoHasCheckrequisitos)) {
                        foreach ($orm_actoadministrativoHasCheckrequisitos as $requisitos) {
                            $listaRequisitos[$i] = $requisitos->getCheckrequisitosIdcheckrequisitos()->getIdcheckrequisitos();
                            $i++;
                        }
                    }

                    return new JsonResponse($listaRequisitos);
                }

// ------------------------------------------------------------------- 

                /**
                 * @Route(path="/verSie/{nroexpediente}", name="ver_sie")
                 */
                function verSieAction($nroexpediente) {

                    $em = $this->getDoctrine()->getManager('default');
                    $sie = new ConsultaSie();
                    $result = $sie->consultarSie($nroexpediente);

//var_dump($result);

                    return new JsonResponse($result);
                }

// ------------------------------------------------------------------- 

                /**
                 * @Route(path="/getAllActos/{idestadoBuscar}" ,name="get_allActos",requirements={"idestadoBuscar"="\d+"})
                 */
                function getAllActos($idestadoBuscar = null) {

                    $em = $this->getDoctrine()->getManager('default');
                    $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

                    $orm_actoadministrativos = $em->getRepository(Actoadministrativo::class)->findAll();

                    /* if ($idestado!=null){
                      echo "buscar por estado ".$idestado;
                      die();
                      } */
                    $i = 0;
                    $arr_result = array();
                    foreach ($orm_actoadministrativos as $unacto) {
                        if (!$unacto->getFechabaja()) {
                            $id = $unacto->getIdactoadministrativo();
                            //buscar ultimo estado
                            $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                            $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                            $id_estado = $orm_estado->getIdestado();
                            $estado_desc = $orm_estado->getEstadodescripcion();

                            //busco ultima ubicacion
                            $ult_movimiento = $em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                            if ($ult_movimiento) {

                                $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                                $orm_area = $em->getRepository(Area::class)->find($idAreaDestino);
                                $ubicacion_actual = $orm_area->getArea();
                                $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                            } else {
                                $ubicacion_actual = "Sin movimiemto";
                                $fecha_ubi = '';
                            }
                            if (!$idestadoBuscar) {
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
                                $arr_result[$i]['estado_actual'] = $estado_desc;
                                $arr_result[$i]['idestado_actual'] = $id_estado;
                                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                                $orm_areaCarga = $em->getRepository(Area::class)->find($unacto->getAreacarga());
                                $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                                $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                                $i++;
                            } else {//busca por estado
                                if ($id_estado == $idestadoBuscar) {
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
                                    $arr_result[$i]['estado_actual'] = $estado_desc;
                                    $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                                    $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                                    $orm_areaCarga = $em->getRepository(Area::class)->find($unacto->getAreacarga());
                                    $arr_result[$i]['area_carga'] = $orm_areaCarga->getArea();
                                    $arr_result[$i]['fechacarga'] = $unacto->getFechacarga()->format("d-m-Y");
                                    $i++;
                                }
                            }
                        }
                        }

                        return $arr_result;
                    }

// ------------------------------------------------------------------- 
                }
                