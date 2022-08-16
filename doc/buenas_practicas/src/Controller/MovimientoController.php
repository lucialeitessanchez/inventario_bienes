<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\movimientoActoType;
use App\Entity\Movimiento;
use App\Entity\Actoadministrativo;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Estadoactoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\Area;
use App\Service\DatosActoAdministrativo;

/**
 * @Route(path="/movimiento")
 */
class MovimientoController extends AbstractController {

    /**
     * @Route(path="/movimientoActo/{area}", name="movimiento_actoAdministrativo")
     */
    public function MovimientoActoAction(Request $request): Response {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $fechaAlta = new \DateTime ();
        $movimiento = new Movimiento();

        $form = $this->createForm(movimientoActoType::class, $movimiento, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if (!$request->request->get('idActoAdministrativo')) {

                $mensaje_txt = "Debe indicar un Acto Administrativo para el movimiento";
                $session->getFlashBag()->add('error', $mensaje_txt);
                return $this->render('movimientoActo.html.twig', array('form' => $form->createView(), 'estado' => ''));
            }
            $idActo = $request->request->get('idActoAdministrativo');


            $orm_acto_administrativo = $em->getRepository(ActoAdministrativo::class)->find($idActo);

            $orm_movimiento = $em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'desc'));

//ultimo estado registrado
            $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'desc'));
            $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
            $id_estado = $orm_estado->getIdestado();
            $desc_estado = $orm_estado->getEstadodescripcion();


            if ($orm_acto_administrativo) {

//guardo movimiento
                $movimiento = new Movimiento();
                $movimiento->setActoadministrativoIdactoadministrativo($orm_acto_administrativo);
                $movimiento->setFechamovimiento($form['fechamovimiento']->getData());
                $movimiento->setAreaIdareaorigen($form['areaIdareaorigen']->getData());
                $movimiento->setAreaIdareadestino($form['areaIdareadestino']->getData());
                $movimiento->setMotivomovimiento($form['motivomovimiento']->getData());
                $movimiento->setFolios($form['folios']->getData());
                $movimiento->setObservacion($form['observacion']->getData());
                $movimiento->setTipomovimiento($form['tipomovimiento']->getData());
                $movimiento->setUsuario($usuariocarga);
                $movimiento->setFechacarga($fechaAlta);


//guardo en estado
                $origen = $form['areaIdareaorigen']->getData()->getIdarea();
                $destino = $form['areaIdareadestino']->getData()->getIdarea();

                $estadoActo = new EstadoactoadministrativoHasActoadministrativo();
                $control = 0;
                $datoscompletos = 0;
                if ($area == 1) {
                    if (($id_estado == 1 || $id_estado == 3) && ($origen == 1 && $destino == 5)) {//de privada a DPCyRI - NO SE MODIFICA ESTADO
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find($id_estado);
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('MOVIMIENTO INTERNO - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }
                    if ($id_estado == 6 && ($origen == 1 && $destino == 6 )) {//de privada a AREA EXTERNA
                        $datoscompletos = $this->controlarDatos($id_estado, $idActo);
                        if ($datoscompletos == 1) {
                            $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find(11); //continuar tramite
                            $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                            $estadoActo->setObservacionestado('CONTINUAR TRAMITE - AUTOMATICO');
                            $desc_estado = $orm_estado_actua->getEstadodescripcion();
                            $control = 1;
                        } else {
                            $mensaje_txt = "EL MOVIMIENTO NO SE GUARDO. Falta ingresar Fecha de Dictamen";
                            $session->getFlashBag()->add('error', $mensaje_txt);
                            return $this->render('movimientoActo.html.twig', array('form' => $form->createView(), 'estado' => $desc_estado));
                        }
                    }
                }

                if ($area == 5) {//DPCyRI
                    if (($id_estado == 1 || $id_estado == 3) && ($origen == 5 && $destino == 2)) {//de DPCyRI a UE
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find(2); //Aprobado en curso
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('APROBADO EN CURSO - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }
                    if (($id_estado == 1 || $id_estado == 3) && ($origen == 5 && $destino == 1)) {//de DPCyRI a Privada - por cualquier eventualidad lo habilito
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find($id_estado); //el mismo estado que tiene
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('MOVIMIENTO INTERNO - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }
                    if (($id_estado == 2) && ($origen == 5 && $destino == 1 )) {//de DPCyRI a PRIVADA - se lo pasa para Dictaminar
                        $datoscompletos = $this->controlarDatos($id_estado, $idActo);
                        if ($datoscompletos == 1) {
                            $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find(6); //continuar tramite
                            $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                            $estadoActo->setObservacionestado('PARA DICTAMINAR - AUTOMATICO');
                            $desc_estado = $orm_estado_actua->getEstadodescripcion();
                            $control = 1;
                        } else {
                            $mensaje_txt = "EL MOVIMIENTO NO SE GUARDO. Falta ingresar alguno de los siquientes datos: \n \n"
                                    . "Nro Expediente, CBU, Monto y/o Fecha de Monto Aprobado, Nro de Sipaf";
                            $session->getFlashBag()->add('error', $mensaje_txt);

                            return $this->render('movimientoActo.html.twig', array('form' => $form->createView(), 'estado' => $desc_estado));
                        }
                    }
                }

                if ($area == 2) {//UE
                    if ($id_estado == 2 && ($origen == 2 && $destino == 5)) {
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find($id_estado); //mismo estado
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('VUELVE A DPCyRI - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }
                }
                if ($area == 3) {//AREA CONVENIOS
                    if ($id_estado == 11 && ($origen == 6 && $destino == 3)) { // de area externa a area convenio
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find(7); //para firma de convenio
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('PARA FIRMA CONVENIO - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }
                    if ($id_estado == 7 && ($origen == 3 && $destino == 6)) {
                        $orm_estado_actua = $em->getRepository(Estadoactoadministrativo::class)->find(8); //para gestion de pago
                        $estadoActo->setEstadoactoadministrativoIdestado($orm_estado_actua);
                        $estadoActo->setObservacionestado('PARA GESTION DE PAGO - AUTOMATICO');
                        $desc_estado = $orm_estado_actua->getEstadodescripcion();
                        $control = 1;
                    }

                    if ($control != 1 && $id_estado == 11) {
                        $mensaje_txt = "EL MOVIMIENTO NO SE GUARDO. Falta ingresar el movimiento de recepción al Área de Convenios";
                        $session->getFlashBag()->add('error', $mensaje_txt);
                        return $this->render('movimientoActo.html.twig', array('form' => $form->createView(), 'estado' => $desc_estado));
                    }
                }

                $estadoActo->setFechaestado($fechaAlta);
                $estadoActo->setFechacarga($fechaAlta);
                $estadoActo->setUsuario($usuariocarga);
                $estadoActo->setActoadministrativoIdactoadministrativo($orm_acto_administrativo);
//-------------------------------------------
                if ($control == 1) {
                    $em->persist($movimiento);
                    $em->persist($estadoActo);
                    $em->flush();

                    $mensaje_txt = 'Se guardó el movimiento correctamente   Estado Actual: ' . $orm_estado_actua->getEstadodescripcion();

                    $session->getFlashBag()->add('aviso', $mensaje_txt);

                    return $this->redirectToRoute("movimiento_actoAdministrativo", array('area' => $area));
                } else {
                    $mensaje_txt = 'NO se guardó el movimiento correctamente - VERIFIQUE';

                    $session->getFlashBag()->add('error', $mensaje_txt);

                    return $this->redirectToRoute("movimiento_actoAdministrativo", array('area' => $area));
                }
            }
        }

        return $this->render('movimientoActo.html.twig', array('form' => $form->createView(), 'estado' => ''));
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/buscarActo/{nroexpediente}/{idActoAdministrativo}", name="buscarActoAdministrativo")
     */
    public function buscarActoAction($nroexpediente, $idActoAdministrativo) {


        $em = $this->getDoctrine()->getManager();

        $arrayDatos = array();
        $array_result = array();

        $datos = new DatosActoAdministrativo($em);

        if ($nroexpediente && !$idActoAdministrativo) {

            $array_result = $datos->getActosPorExpediente($nroexpediente);
        }

        if (!$nroexpediente && $idActoAdministrativo) {

            $array_result = $datos->getActoPorId($idActoAdministrativo);
        }

// array_result puede devolver mas de uno, pero para el movimiento se debe tomar 1=>si busca por nro de expediente 
//                                                                                   y devuelve mas de uno, es porque se cargo mal el nro
        if (count($array_result) != 0) {
            $id_estado = $array_result[0]['idestado_actual'];


            if ($id_estado != 4 && $id_estado != 9 && $id_estado != 10 && $id_estado != 12) { //no aprobado - pagado - rendido - tramitado por otro programa
                $arrayDatos = $array_result[0];
            }
        }

        return new JsonResponse($arrayDatos);
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/controlarDatos/{id_estado}/{idActo}", name="controlar_datos")
     */
    public function controlarDatos($id_estado, $idActo) {

        $em = $this->getDoctrine()->getManager();

        $orm_acto = $em->getRepository(Actoadministrativo::class)->find($idActo);
        $completo = 0;
// if ($id_estado == 1 || $id_estado == 3) {
        if ($id_estado == 2) {
            /* if ($orm_acto->getNroexpediente() && $orm_acto->getFechaexpediente() && $orm_acto->getMontoaprobado() &&
              $orm_acto->getFechamontoaprobado() && $orm_acto->getCaratula() && $orm_acto->getFechacaratula() &&
              $orm_acto->getCbuinstitucion() && $orm_acto->getNrosipaf()) */
            if ($orm_acto->getNroexpediente() && $orm_acto->getFechaexpediente() && $orm_acto->getMontoaprobado() &&
                    $orm_acto->getFechamontoaprobado() && $orm_acto->getCbuinstitucion() && $orm_acto->getNrosipaf())
                $completo = 1;
        }
        if ($id_estado == 6) {
            if ($orm_acto->getFechadictamen())
                $completo = 1;
        }
        return $completo;
    }

}
