<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\bajaActoType;
use App\Entity\Actoadministrativo;
use App\Entity\ActoadministrativoHasComponente;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Estadoactoadministrativo;
use App\Entity\EstadoactoadministrativoHasActoadministrativo;
use App\Entity\ObservacionesBp;
use App\Entity\Movimiento;
use App\Entity\Area;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\tablascomunes\TLoc;

/**
 * @Route(path="/baja")
 */
class BajaController extends AbstractController {

    /**
     * @Route(path="/buscarparaBajaActo", name="buscarparaBaja_actoAdministrativo")
     */
    public function BuscarparaBajaActoAction(Request $request) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $actoadministrativo = new Actoadministrativo();
        $form = $this->createForm(bajaActoType::class, $actoadministrativo, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');


        $orm_actoadministrativos = $em->getRepository(Actoadministrativo::class)->findAll();
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

                $arr_result[$i]['nroacto'] = $unacto->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = $unacto->getNronota();
                if ($unacto->getFechanota()) {
                    $arr_result[$i]['fechanota'] = $unacto->getFechanota()->format("d-m-Y");
                } else {
                    $arr_result[$i]['fechanota'] = '';
                }
                $arr_result[$i]['institucion'] = $unacto->getNombreinstitucion();
                $arr_result[$i]['localidad'] = $unacto->getLocalidadinst();
                $arr_result[$i]['departamento'] = $unacto->getDepartamentoinst();
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;
                $i++;
            }
        }

        if ($form->isSubmitted()) {

            if ($form->get('filtrarLista')->isClicked()) {
                $idActo = $request->request->get('idActoAdministrativo_filtra');

                $i = 0;
                $arr_result = array();
                $orm_actoadministrativo = $em->getRepository(Actoadministrativo::class)->find($idActo);

                //buscar ultimo estado
                $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'desc'));
                $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();
                $estado_desc = $orm_estado->getEstadodescripcion();

                //busco ultima ubicacion
                $ult_movimiento = $em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $idActo), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {

                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();

                    $orm_area = $em->getRepository(Area::class)->find($idAreaDestino);
                    $ubicacion_actual = $orm_area->getArea();
                    $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");
                } else {
                    $ubicacion_actual = "Sin movimiemto";
                    $fecha_ubi = '';
                }

                $arr_result[$i]['nroacto'] = $orm_actoadministrativo->getIdactoadministrativo();
                $arr_result[$i]['nronota'] = $orm_actoadministrativo->getNronota();
                $arr_result[$i]['fechanota'] = $orm_actoadministrativo->getFechanota()->format("d-m-Y");
                $arr_result[$i]['institucion'] = $orm_actoadministrativo->getNombreinstitucion();
                $arr_result[$i]['localidad'] = $orm_actoadministrativo->getLocalidadinst();
                $arr_result[$i]['departamento'] = $orm_actoadministrativo->getDepartamentoinst();
                $arr_result[$i]['estado_actual'] = $estado_desc;
                $arr_result[$i]['ubicacion_actual'] = $ubicacion_actual;
                $arr_result[$i]['fecha_ubi'] = $fecha_ubi;

                return $this->render('bajaActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => $idActo, 'baja' => 1, 'institucion' => ''));
            }
        }
        return $this->render('bajaActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => '', 'baja' => 0, 'institucion' => ''));
    }

    /**
     * @Route(path="/bajaActo/{idactoadministrativo}", name="baja_actoAdministrativo")
     */
    public function BajaActoAction($idactoadministrativo) {



        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');


        $orm_acto = $em->getRepository(Actoadministrativo::class)->find($idactoadministrativo);
        $orm_acto->setFechabaja(new \DateTime());
        $orm_acto->setMotivobaja("ERROR DE INGRESO");
        $em->persist($orm_acto);
        $em->flush();

        return $this->redirectToRoute('buscarparaBaja_actoAdministrativo');


        //  return $this->render('datosActo.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'idactoadministrativo' => '', 'institucion' => ''));
    }

// ------------------------------------------------------------------- 
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
