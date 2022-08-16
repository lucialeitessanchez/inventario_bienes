<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use App\Form\modificarActoType;
use App\Form\seguimientoActoType;
use App\Entity\Actoadministrativo;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Estadoactoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\ObservacionesBp;
use App\Entity\Area;
use App\Entity\Checkrequisitos;
use App\Entity\ActoadministrativoHasCheckrequisitos;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\tablascomunes\TLoc;

/**
 * @Route(path="/modificar")
 */
class ModificarController extends AbstractController {

    /**
     * @Route(path="/modificarActo/{idactoadministrativo}", name="modificar_actoAdministrativo")
     */
    public function ModificarActoAction(Request $request): Response {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $ingreso = new Actoadministrativo();
        $form = $this->createForm(modificarActoType::class, $ingreso, array('em' => $em, 'em_instituciones' => $em_instituciones));
        $form->handleRequest($request);
        $data = $request->request->get('form');

        $fechaAlta = new \DateTime ();
        $idActo = $request->request->get('idactoadministrativo');
        $array_observaciones = array();
        $array_adjuntos = array();

        if ($idActo) {//busco ultimo estado
            $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'desc'));
            $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
            $id_estado = $orm_estado->getIdestado();
            $estado_desc = $orm_estado->getEstadodescripcion();

            $orm_institucion = $em_instituciones->getRepository(Institucion::class)->find($form['instId']->getData());
            $instId = $orm_institucion->getInstId();
            $orm_loc = $em->getRepository(TLoc::class)->find($form['localidad']->getData());
            $localidadInst = $orm_loc->getLoc();
//busco observaciones bp
            $array_observaciones = $em->getRepository(ObservacionesBp::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'asc'));
//busco area_carga
            $orm_acto = $em->getRepository(Actoadministrativo::class)->find($idActo);
            $orm_areaCarga = $em->getRepository(Area::class)->find($orm_acto->getAreacarga());
            $area_carga = $orm_areaCarga->getArea();
//busco observaciones bp
            $array_observaciones = $em->getRepository(ObservacionesBp::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'asc'));

//busco adjuntos
            $orm_archivos = $em->getRepository(Archivo::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));
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
        }
        if ($form->isSubmitted()) {


            $ingreso_up = $em->getRepository(Actoadministrativo::class)->find($idActo);
            $ingreso_up->setNronota($form['nroNota']->getData());
            if (!empty($form['fechaNota']->getData()))
                $ingreso_up->setFechanota($form['fechaNota']->getData());
            $ingreso_up->setTiposolicitanteIdtiposolicitante($form['tiposolicitanteIdtiposolicitante']->getData());
            $ingreso_up->setMontosolicitado($form['montoSolicitado']->getData());

            $ingreso_up->setReferente($form['referente']->getData());
            $ingreso_up->setReferente2($form['referente2']->getData());
            $ingreso_up->setReferente2codigoarea($form['referente2codigoarea']->getData());
            $ingreso_up->setReferente2te($form['referente2te']->getData());
            $ingreso_up->setReferente2mail($form['referente2mail']->getData());
            $ingreso_up->setContactoapenom($form['contactoapenom']->getData());
            $ingreso_up->setContactocodigoarea($form['contactocodigoarea']->getData());
            $ingreso_up->setContactote($form['contactote']->getData());
            $ingreso_up->setContactomail($form['contactomail']->getData());
            $ingreso_up->setTramiteurgente($form['tramiteurgente']->getData());
            $ingreso_up->setObservacion($form['observacion']->getData());

//los datos que deberia ingresar antes de enviar a UE
            $ingreso_up->setNroexpediente($form['nroexpediente']->getData());
            // $ingreso_up->setFechaexpediente($form['fechaexpediente']->getData());
            if (!$ingreso_up->getFechaExpediente()) {
                $fechaexp = new \DateTime($request->request->get('form_fechaexpediente'));
                $ingreso_up->setFechaexpediente($fechaexp);
            }
            //$ingreso_up->setCaratula($form['caratula']->getData());
            //$ingreso_up->setFechacaratula($form['fechacaratula']->getData());
            $ingreso_up->setMontoaprobado($form['montoaprobado']->getData());
            $ingreso_up->setFechamontoaprobado($form['fechamontoaprobado']->getData());
            $ingreso_up->setCbuinstitucion($form['cbuinstitucion']->getData());
            $ingreso_up->setNrosipaf($form['nrosipaf']->getData());

//REQUISITOS
            $listaRequisitos = array();
            $listaRequisitos_old = array();
//guardo requisitos
            $listaRequisitos = $form['detallerequisito']->getData();

            if ($form['detallerequisito']->getData()) {

//primero borro lo que esta
                $listaRequisitos_old = $em->getRepository(ActoadministrativoHasCheckrequisitos::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));
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
                    $actoHascheck->setActoadministrativoIdactoadministrativo($ingreso_up);
                    $actoHascheck->setCheckrequisitosIdcheckrequisitos($orm_requisitos);
                    $actoHascheck->setFechacarga(new \DateTime());

                    $em->persist($actoHascheck);
                }
            }

//guardo componentes
            $listaComponentes = array();
            $listaComponentes_old = array();

            $listaComponentes = $form['detallecomponenteIddetallecomponentesolicitado']->getData();

            $actoHasComponente_borrar = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idActo));
            if (!empty($actoHasComponente_borrar)) {
                foreach ($actoHasComponente_borrar as $detallecomponente) {
                    $em->remove($detallecomponente);
                    $em->flush();
                }
            }

            foreach ($listaComponentes as $detallecomponente) {
                $orm_componente = $em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponente());

                $actoHasComponente = new ActoadministrativoHasComponente();
                $actoHasComponente->setActoadministrativoIdactoadministrativo($ingreso_up);
                $actoHasComponente->setComponenteIdcomponentesolicitado($orm_componente);
                $actoHasComponente->setDetallecomponenteIddetallecomponentesolicitado($detallecomponente);
                $actoHasComponente->setFechaSolicitado($form['fechaNota']->getData());
                $em->persist($actoHasComponente);
            }

//buscar localidad
            $orm_loc = $em->getRepository(TLoc::class)->find($form['localidad']->getData());
            $localidadInst = $orm_loc->getLoc();
            $localidad = $orm_loc->getIdLoc();

            $ingreso_up->setIdlocalidadinst($orm_loc->getIdLoc());
            $ingreso_up->setLocalidadinst($orm_loc->getLoc());
            $ingreso_up->setDepartamentoinst($orm_loc->getDepto());

//buscar institucion
            $orm_institucion = $em_instituciones->getRepository(Institucion::class)->find($form['instId']->getData());
            $instId = $orm_institucion->getInstId();
            $nombreInst = $orm_institucion->getInstNom();
            $ingreso_up->setInstId($orm_institucion->getInstId());
            $ingreso_up->setNombreinstitucion($orm_institucion->getInstNom());

//adjuntar archivos
            $informeFile = $form['brochure']->getData();
            $tipoDocumento = $form['idtipodocumento']->getData();
            /* UPLOAD FILE */
            if ($informeFile) {
                if ($tipoDocumento) {
                    $originalFilename = pathinfo($informeFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $informeFile->guessExtension();

                    $hoy = new \Datetime("now");
                    $dir = $hoy->format('Y') . "-" . $hoy->format('m');

                    $pathDondeGuarde = $this->getParameter('informeFile_directory') . "/" . $dir;
                    // Move the file to the directory where brochures are stored
                    try {
                        $informeFile->move(
                                //$this->getParameter('informeFile_directory'), $newFilename
                                $pathDondeGuarde, $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents

                    $orm_archivo = new Archivo();

                    $orm_archivo->setActoadministrativoIdactoadministrativo($ingreso_up);
                    $orm_tipodocumento = $em->getRepository(Tipodocumento::class)->find($form['idtipodocumento']->getData());
                    $orm_archivo->setTipoDocumentoIdTipodocumento($orm_tipodocumento);
                    $orm_archivo->setDescripcion($form['observacionbp']->getData());
                    //$orm_archivo->setNombrearchivo($newFilename);
                    //$orm_archivo->setPath($pathDondeGuarde);
                    $orm_archivo->setNombrearchivo($newFilename);
                    $orm_archivo->setPath($dir . "/" . $newFilename);
                    $orm_archivo->setFechaupload(new \DateTime());
                    $em->persist($orm_archivo);
                } else {
                    $mensaje_txt = 'NO se adjunto el documento. Verifique si selecciono el Tipo de documento';
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('modificarActo.html.twig', array('form' => $form->createView(), 'array_observaciones' => $array_observaciones, 'instId' => $orm_institucion, 'localidad' => $orm_loc, 'idactoadministrativo' => $idActo, 'estado' => $estado_desc, 'areacarga' => $area_carga, 'array_adjuntos' => $array_adjuntos));
                }
            }

//guardo observacionesBP
            if ($form['observacionbp']->getData()) {
                $orm_observacionesBp = new ObservacionesBp();
                $orm_observacionesBp->setActoadministrativoIdactoadministrativo($ingreso_up);
                $orm_observacionesBp->setObservacion($form['observacionbp']->getData());
                $orm_observacionesBp->setFechaobs(new \DateTime());
                $orm_observacionesBp->setFechacarga(new \DateTime());
                $orm_observacionesBp->setUsuario($usuariocarga);
                $em->persist($orm_observacionesBp);
            }

//guardo estado si area es 1 ó 3 (cuando area es 5 lo guardo desde datosActoController)
            if ($form['idestado']->getData()) {

                $estado = $em->getRepository(Estadoactoadministrativo::class)->find($form['idestado']->getData());
                $estadoActo = new EstadoactoadministrativoHasActoadministrativo();
                $estadoActo->setFechaestado($fechaAlta);
                $estadoActo->setEstadoactoadministrativoIdestado($estado); //el que seleccione el usuario
                $estadoActo->setFechacarga($fechaAlta);
                $estadoActo->setUsuario($usuariocarga);
                $estadoActo->setActoadministrativoIdactoadministrativo($ingreso_up);
                $estadoActo->setObservacionestado('CAMBIO DE ESTADO POR EDICION');
                $estado_desc = $estado->getEstadodescripcion();
                $em->persist($estadoActo);
            }

            $em->persist($ingreso_up);

            $em->flush();



            $mensaje_txt = 'Se ACTUALIZARON los datos correctamente';
            $session->getFlashBag()->add('aviso', $mensaje_txt);
            return $this->render('modificarActo.html.twig', array('form' => $form->createView(), 'array_observaciones' => $array_observaciones, 'instId' => $orm_institucion, 'localidad' => $orm_loc, 'idactoadministrativo' => $idActo, 'estado' => $estado_desc, 'areacarga' => $area_carga, 'array_adjuntos' => $array_adjuntos));
        }


        return $this->render('modificarActo.html.twig', array('form' => $form->createView(), 'array_observaciones' => $array_observaciones, 'instId' => $orm_institucion, 'localidad' => $orm_loc, 'idactoadministrativo' => $idActo, 'estado' => $estado_desc, 'areacarga' => $area_carga, 'array_adjuntos' => $array_adjuntos));
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/listaComponentes/{idactoadministrativo}", name="get_lista_componentes")
     */
    function getListaComponentes($idactoadministrativo) {

        $em = $this->getDoctrine()->getManager('default');
        $listaComponentes = array();
        $i = 0;
//obtengo el acto administrativo
//$ormSituacionEco = $em->getRepository(Situacioneconomica::class)->findOneBy(array('usuarioIdusuario' => $usuarioId));
// $orm_actoAdministrativo=$em->getRepository(Actoadministrativo::class)->find(array('idactoadministrativo' => $idActo));
//echo '----  '.$ormSituacionEco->getIdsituacioneconomica();
        $orm_actoadministrativoHasComponente = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));
//echo '--'. count($ormSitucionEcoBene);
        if (!empty($orm_actoadministrativoHasComponente)) {
            foreach ($orm_actoadministrativoHasComponente as $componentes) {
                $listaComponentes[$i] = $componentes->getDetallecomponenteIddetallecomponentesolicitado()->getIddetallecomponente();
                $i++;
            }
        }

        return new JsonResponse($listaComponentes);
    }

// -------------------------------------------------------------------     

    /*
      public function salir()
      {
      //echo 'esta es una prueba de logout'.$this->getParameter('url_portal');
      //die('dsfdsfd');
      //return new RedirectResponse($this->getParameter('url_portal'));

      return new RedirectResponse($this->getParameter('url_portal'));
      }

      public function logout() {
      return $this->render('logout.html.twig');
      }
     */
}
