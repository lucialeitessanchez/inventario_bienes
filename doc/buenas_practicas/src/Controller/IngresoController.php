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
use App\Form\ingresoActoType;
use App\Form\seguimientoActoType;
use App\Entity\Actoadministrativo;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Estadoactoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\ObservacionesBp;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\tablascomunes\TLoc;

/**
 * @Route(path="/ingreso")
 */
class IngresoController extends AbstractController {

    /**
     * @Route(path="/ingresoActo", name="ingreso_actoAdministrativo")
     */
    public function IngresoActoAction(Request $request): Response {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $ingreso = new Actoadministrativo();
        $form = $this->createForm(ingresoActoType::class, $ingreso, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');
        $array_adjuntos = array();
        $fechaAlta = new \DateTime ();

        if ($form->isSubmitted()) {

//seteo valores
            $ingreso->setNronota($form['nroNota']->getData());
            if (!empty($form['fechaNota']->getData()))
                $ingreso->setFechanota($form['fechaNota']->getData());

            $ingreso->setTiposolicitanteIdtiposolicitante($form['tiposolicitanteIdtiposolicitante']->getData());

//busco idlocalidad

            $loc_aux = $em->getRepository(TLoc::class)->find($form['localidad']->getData());
            $ingreso->setIdlocalidadinst($loc_aux->getIdLoc());
            $ingreso->setLocalidadinst($loc_aux->getLoc());
            $ingreso->setDepartamentoinst($loc_aux->getDepto());

//busco nombre institucion
            $inst_aux = $em_instituciones->getRepository(Institucion::class)->find($form['instId']->getData());

            $ingreso->setInstId($inst_aux->getInstId());
            $ingreso->setNombreinstitucion($inst_aux->getInstNom());

            $nrosipaf = $inst_aux->getInstNroSipaf();
            if ($nrosipaf)
                $ingreso->setNrosipaf($nrosipaf);

//$ingreso->setDescripcionproyecto($form['descripcionProyecto']->getData());
            $ingreso->setMontosolicitado($form['montoSolicitado']->getData());

            $ingreso->setReferente($form['referente']->getData());
            $ingreso->setReferente2($form['referente2']->getData());
            $ingreso->setReferente2codigoarea($form['referente2codigoarea']->getData());
            $ingreso->setReferente2te($form['referente2te']->getData());
            $ingreso->setReferente2mail($form['referente2mail']->getData());
            $ingreso->setContactoapenom($form['contactoapenom']->getData());
            $ingreso->setContactocodigoarea($form['contactocodigoarea']->getData());
            $ingreso->setContactote($form['contactote']->getData());
            $ingreso->setContactomail($form['contactomail']->getData());
            $ingreso->setTramiteurgente($form['tramiteurgente']->getData());
            $ingreso->setObservacion($form['observacion']->getData());
            $ingreso->setAreacarga($area);
            $ingreso->setUsuario($usuariocarga);
            $ingreso->setFechacarga($fechaAlta);

            $listaComponentes = array();
//guardo componentes seleccionados
            $listaComponentes = $form['detallecomponenteIddetallecomponentesolicitado']->getData();

            foreach ($listaComponentes as $detallecomponente) {
                $orm_componente = $em->getRepository(Componente::class)->find($detallecomponente->getComponenteIdcomponente());

                $actoHasComponente = new ActoadministrativoHasComponente();
                $actoHasComponente->setActoadministrativoIdactoadministrativo($ingreso);
                $actoHasComponente->setComponenteIdcomponentesolicitado($orm_componente);
//$actoHasComponente->setDetallecomponenteIddetallecomponentesolicitado($detallecomponente->getIddetallecomponente());
                $actoHasComponente->setDetallecomponenteIddetallecomponentesolicitado($detallecomponente);
                if (!empty($form['fechaNota']->getData())) {
                    $actoHasComponente->setFechaSolicitado($form['fechaNota']->getData());
                } else {
                    $actoHasComponente->setFechaSolicitado(new \DateTime());
                }
                $em->persist($actoHasComponente);
            }

//guardo estado
            $estado = $em->getRepository(Estadoactoadministrativo::class)->find(1);
            $estadoActo = new EstadoactoadministrativoHasActoadministrativo();
            $estadoActo->setFechaestado($fechaAlta);
            $estadoActo->setEstadoactoadministrativoIdestado($estado); //INICIADO
            $estadoActo->setFechacarga($fechaAlta);
            $estadoActo->setUsuario($usuariocarga);
            $estadoActo->setActoadministrativoIdactoadministrativo($ingreso);
            $estadoActo->setObservacionestado('ALTA DE LA NOTA - AUTOMATICO');

//guardo adjuntos
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

                    $orm_archivo->setActoadministrativoIdactoadministrativo($ingreso);
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
                    $mensaje_txt = 'ERROR al adjuntar el documento. Verifique si selecciono el Tipo de documento';
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('ingresoActo.html.twig', array('form' => $form->createView()));
                }
            }
//guardo observacionesBP
            if ($form['observacionbp']->getData()) {
                $orm_observacionesBp = new ObservacionesBp();
                $orm_observacionesBp->setActoadministrativoIdactoadministrativo($ingreso);
                $orm_observacionesBp->setObservacion($form['observacionbp']->getData());
                $orm_observacionesBp->setFechaobs(new \DateTime());
                $orm_observacionesBp->setFechacarga(new \DateTime());
                $orm_observacionesBp->setUsuario($usuariocarga);
                $em->persist($orm_observacionesBp);
            }

            $em->persist($ingreso);
            $em->persist($estadoActo);
            $em->flush();
            $mensaje_txt = 'Se guardaron correctamente los datos NRO ACTO ADMINISTRATIVO: ' . $ingreso->getIdactoadministrativo();
            $session->getFlashBag()->add('aviso', $mensaje_txt);

            // return $this->render('ingresoActo.html.twig', array('form' => $form->createView()));
            return $this->redirectToRoute('ingreso_actoAdministrativo');
        } else {

            return $this->render('ingresoActo.html.twig', array('form' => $form->createView()));
        }
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/listaComponentes/{idactoadministrativo}", name="get_lista_componentes")
     */
    function getListaComponentes($idactoadministrativo) {

        $em = $this->getDoctrine()->getManager('default');
        $listaComponentes = array();
        $i = 0;

        $orm_actoadministrativoHasComponente = $em->getRepository(ActoadministrativoHasComponente::class)->findBy(array('actoadministrativoIdactoadministrativo' => $idactoadministrativo));

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
