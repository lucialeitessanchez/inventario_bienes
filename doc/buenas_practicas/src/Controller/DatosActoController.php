<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use App\Form\datosActoType;
use App\Entity\ObservacionesBp;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
use App\Entity\Actoadministrativo;
use App\Entity\Estadoactoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;

/**
 * @Route(path="/datosacto")
 */
class DatosActoController extends AbstractController {

    /**
     * @Route(path="/guardar/{idactoadministrativo}", name="guardar")
     */
    public function guardarAction(Request $request, $idactoadministrativo) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $orm_acto = $em->getRepository(Actoadministrativo::class)->find($idactoadministrativo);

        $form = $this->createForm(datosActoType::class, $orm_acto, array('em' => $em, 'em_instituciones' => $em_instituciones));
//dump($orm_acto);
        $form->handleRequest($request);
        //      $data = $request->request->get('form');

        if ($form->isSubmitted()) {

            if ($form['observacionbp']->getData()) {
                $orm_observacionesBp = new ObservacionesBp();
                $orm_observacionesBp->setActoadministrativoIdactoadministrativo($orm_acto);
                $orm_observacionesBp->setObservacion($form['observacionbp']->getData());
                $orm_observacionesBp->setFechaobs(new \DateTime());
                $orm_observacionesBp->setFechacarga(new \DateTime());
                $orm_observacionesBp->setUsuario($usuariocarga);
                $em->persist($orm_observacionesBp);
                //   $em->flush();
            }
            if ($area == 1) { //actualiza fecha dictamen
                if ($form['fechadictamen']->getData() || $form['observaciondictamen']->getData()) {

                    //guardo fecha y obs dictamen 

                    $orm_acto->setFechadictamen($form['fechadictamen']->getData());
                    $orm_acto->setObservaciondictamen($form['observaciondictamen']->getData());

                    $em->persist($orm_acto);
                    //   $em->flush();
                }
            }
            if ($area == 5) { //actualiza estado, fecha pago y datos de resolucion
                if ($form['idestado']->getData()) {

                    //guardo estado
                    $estado = $em->getRepository(Estadoactoadministrativo::class)->find($form['idestado']->getData()->getIdestado());
                    $estadoActo = new EstadoactoadministrativoHasActoadministrativo();
                    $estadoActo->setFechaestado(new \DateTime());
                    $estadoActo->setEstadoactoadministrativoIdestado($estado); //el que seleccione el usuario
                    $estadoActo->setFechacarga(new \DateTime());
                    $estadoActo->setUsuario($usuariocarga);
                    $estadoActo->setActoadministrativoIdactoadministrativo($orm_acto);
                    $estadoActo->setObservacionestado('CAMBIO DE ESTADO POR EDICION');
                    $estado_desc = $estado->getEstadodescripcion();

                    $em->persist($estadoActo);
                }
                //guardo fechapago y resolucion
                $orm_acto->setFechapago($form['fechapago']->getData());
                $orm_acto->setNroresolucion($form['nroresolucion']->getData());
                $orm_acto->setFecharesolucion($form['fecharesolucion']->getData());

                $em->persist($orm_acto);
            }

            //  if ($area == 2) {
            $informeFile = $form['brochure']->getData();
            $tipoDocumento = $form['idtipodocumento']->getData();
            /* UPLOAD FILE */

            if ($informeFile) { //para todas las areas
                if ($tipoDocumento){
                $originalFilename = pathinfo($informeFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $informeFile->guessExtension();

                $hoy = new \Datetime("now");
                $dir = $hoy->format('Y') . "-" . $hoy->format('m');

                $pathDondeGuarde = $this->getParameter('informeFile_directory') . $dir;
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

                $orm_archivo->setActoadministrativoIdactoadministrativo($orm_acto);
                $orm_tipodocumento = $em->getRepository(Tipodocumento::class)->find($form['idtipodocumento']->getData());
                $orm_archivo->setTipoDocumentoIdTipodocumento($orm_tipodocumento);
                $orm_archivo->setDescripcion($form['observacionbp']->getData());
                $orm_archivo->setNombrearchivo($newFilename);
                $orm_archivo->setPath($dir . "/" . $newFilename);
                $orm_archivo->setFechaupload(new \DateTime());
                $orm_archivo->setUsuarioalta($usuariocarga);
                $em->persist($orm_archivo);
            } else {
                $mensaje_txt = 'ERROR al adjuntar el documento. Verifique si selecciono el Tipo de documento';
                $session->getFlashBag()->add('error', $mensaje_txt);
                
                return $this->redirectToRoute('ver_acto', array('idactoadministrativo' => $idactoadministrativo));
                //return $this->render('datosActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => '', 'institucion' => ''));
            }
            
            }
            
            $em->flush();
        }
        $mensaje_txt = 'Se guardaron correctamente los datos';
        $session->getFlashBag()->add('aviso', $mensaje_txt);
        return $this->redirectToRoute('ver_acto', array('idactoadministrativo' => $idactoadministrativo));
        //return $this->render('datosActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => '', 'institucion' => ''));
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/eliminarObservacionBP/{idobservacion}/{idactoadministrativo}", name="eliminar_obp")
     */
    public function eliminarObservacionBPAction($idobservacion, $idactoadministrativo) {

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        if ($idobservacion) {
            $orm_obp = $em->getRepository(ObservacionesBp::class)->find($idobservacion);

            $em->remove($orm_obp);
            $em->flush();
        }
        return $this->redirectToRoute('ver_acto', array('idactoadministrativo' => $idactoadministrativo));


        //  return $this->render('datosActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => '', 'institucion' => ''));
    }

}
