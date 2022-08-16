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
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Form\reportesActoType;
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
use App\Report\Reportes;
use App\Service\DatosActoAdministrativo;
use App\Service\ConsultaSie;
use App\Service\IOINPUT;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/reportes")
 */
class ReportesController extends AbstractController {
// ------------------------------------------------------------------- 

    /**
     * @Route(path="/reportesEvaluaSecretario", name="reportes_evalua_secretario")
     */
    public function reportesEvaluaSecretario(Request $request) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $reporte = new Actoadministrativo();
        $form = $this->createForm(reportesActoType::class, $reporte, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');

        $orm_actoadministrativos = $em->getRepository(Actoadministrativo::class)->findAll();
        $array_idActos = array();
        $arr_result = array();

        $i = 0;
        //busco ultimo estado para cada acto

        foreach ($orm_actoadministrativos as $unacto) {

            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();

                //buscar ultimo estado
                $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();

                /* ARMO ARRAY CON TODOS LOS REGISTROS - En estado iniciado o aprobado a la espera */
                if ($id_estado == 1 || $id_estado == 3) {
                    $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                    $i++;
                }
                /* NO SEPARO QUE MUESTRE POR AREA DE INGRESO
                  if ($area == 1) {
                  if ($unacto->getAreacarga() == 1 && ($id_estado == 1 || $id_estado == 3)) {//para area 1 muestro los iniciados y aprobados en espera
                  $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                  $i++;
                  }
                  }
                  if ($area == 5) {
                  if ($unacto->getAreacarga() == 5 && ($id_estado == 1 || $id_estado == 3)) {//para area 5 muestro los iniciados y aprobados en espera
                  $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                  $i++;
                  }
                  }
                 */
            }
        }
        rsort($array_idActos);
        $datosActo = new DatosActoAdministrativo($em);

        //completo datos de los actos
        for ($i = 0; $i < count($array_idActos); $i++) {

            $id = $array_idActos[$i]['idActo'];
            $arraux = $datosActo->getActoPorId($id);
            $arr_result[$i] = $arraux[0];
        }
        /*
echo "<pre>";
print_r($arr_result);
echo "</pre>";*/
        if ($form->isSubmitted()) {

            if ($form->get('filtrar')->isClicked()) {

                if (!$form['fechaDesde']->getData() || !$form['fechaHasta']->getData()) {

                    $mensaje_txt = "Para Filtrar debe ingresar un rango válido de fecha";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesEvaluaSecretario.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }
                $arr_result_rango = array();
                $fdesde = $form['fechaDesde']->getData();
                $fhasta = $form['fechaHasta']->getData();
                $x = 0;

                for ($i = 0; $i < count($arr_result); $i++) {
                    $fechacompara = new \DateTime($arr_result[$i]['fechacarga']);

                    if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                        //   if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                        $arr_result_rango[$x] = $arr_result[$i];
                        $x++;
                    }
                }
                // rsort($arr_result_rango);
                return $this->render('reportesEvaluaSecretario.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result_rango, 'totreg' => count($arr_result_rango), 'area' => $area));
            }

            if ($form->get('evalua_secretario')->isClicked()) {

                if (!$request->request->get('actos')) {

                    $mensaje_txt = "Para Generar reporte debe incluir al menos un acto administrativo";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesEvaluaSecretario.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }

                $arr_imprime = $request->request->get('actos');

                for ($i = 0; $i < count($arr_imprime); $i++) {
                    $arraux = $datosActo->getActoPorId($arr_imprime[$i]);
                    $arr_result_info[$i] = $arraux[0];
                }
                $pdf = new Reportes('L');
                $pdf->printReport_EvaluarSecretario($arr_result_info);
                // limpiar el buffer de datos
                ob_end_clean();
                $pdf->Output("evaluaSecretario.pdf", 'I');


                //die();
            }
        }

        return $this->render('reportesEvaluaSecretario.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/reportesParaUE", name="reportes_para_UE")
     */
    public function reportesParaUE(Request $request) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $reporte = new Actoadministrativo();
        $form = $this->createForm(reportesActoType::class, $reporte, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');

        $orm_actoadministrativos = $em->getRepository(Actoadministrativo::class)->findAll();
        $array_idActos = array();
        $arr_result = array();

        $i = 0;
        //busco ultimo estado para cada acto

        foreach ($orm_actoadministrativos as $unacto) {

            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();

                //buscar ultimo estado
                $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();

                if ($id_estado == 2) {//muestro los aprobados en curso
                    $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                    $i++;
                }

                /* NO MUESTRO MAS DISCRIMINADO POR AREA
                  if ($area == 1) {
                  if ($unacto->getAreacarga() == 1 && $id_estado == 2) {//para area 1 muestro los aprobados en curso
                  $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                  $i++;
                  }
                  }
                  if ($area == 5) {
                  if ($unacto->getAreacarga() == 5 && $id_estado == 2) {//para area 5 muestro los aprobados en curso
                  $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                  $i++;
                  }
                  }
                 */
            }
        }

        $datosActo = new DatosActoAdministrativo($em);

        //completo datos de los actos
        for ($i = 0; $i < count($array_idActos); $i++) {

            $id = $array_idActos[$i]['idActo'];
            $arraux = $datosActo->getActoPorId($id);
            $arr_result[$i] = $arraux[0];
        }
        rsort($arr_result);

        if ($form->isSubmitted()) {

            if ($form->get('filtrar')->isClicked()) {

                if (!$form['fechaDesde']->getData() || !$form['fechaHasta']->getData()) {

                    $mensaje_txt = "Para Filtrar debe ingresar un rango válido de fecha";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesParaUE.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }
                $arr_result_rango = array();
                $fdesde = $form['fechaDesde']->getData();
                $fhasta = $form['fechaHasta']->getData();
                $x = 0;
                for ($i = 0; $i < count($arr_result); $i++) {
                    $fechacompara = new \DateTime($arr_result[$i]['fechacarga']);

                    if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                        $arr_result_rango[$x] = $arr_result[$i];
                        $x++;
                    }
                }
                /*
                  for ($i = 0; $i < count($arr_result); $i++) {
                  if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                  $arr_result_rango[$x] = $arr_result[$i];
                  $x++;
                  }
                  } */
                rsort($arr_result_rango);
                return $this->render('reportesParaUE.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result_rango, 'totreg' => count($arr_result_rango), 'area' => $area));
            }

            if ($form->get('envio_ue')->isClicked()) {

                if (!$request->request->get('actos')) {

                    $mensaje_txt = "Para Generar reporte debe incluir al menos un acto administrativo";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesParaUE.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }

                $arr_imprime = $request->request->get('actos');

                for ($i = 0; $i < count($arr_imprime); $i++) {
                    $arraux = $datosActo->getActoPorId($arr_imprime[$i]);
                    $arr_result_info[$i] = $arraux[0];
                }
                $pdf = new Reportes('L');
                $pdf->printReport_EnvioA_UE($arr_result_info);
                // limpiar el buffer de datos
                ob_end_clean();
                $pdf->Output("envioUE.pdf", 'I');


                //die();
            }
        }

        return $this->render('reportesParaUE.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
    }

// ------------------------------------------------------------------- 

    /**
     * @Route(path="/reportesParaDictaminar", name="reportes_para_dictaminar")
     */
    public function reportesParaDictaminar(Request $request) { //remitidos a DPCyRI por UNIDAD EVALUADORA
        /* todos los expedientes que la UE remita a la secretaría con el informe social completo */

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager('default');
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $area = $this->getUser()->getOficinas();
        $usuariocarga = $this->getUser()->getUsername();

        $reporte = new Actoadministrativo();
        $form = $this->createForm(reportesActoType::class, $reporte, array('em' => $em, 'em_instituciones' => $em_instituciones));

        $form->handleRequest($request);
        $data = $request->request->get('form');

        $orm_actoadministrativos = $em->getRepository(Actoadministrativo::class)->findAll();
        $array_idActos = array();
        $arr_result = array();
        $i = 0;

        //busco ultimo estado para cada acto
        foreach ($orm_actoadministrativos as $unacto) {

            if (!$unacto->getFechabaja()) {
                $id = $unacto->getIdactoadministrativo();

                //buscar ultimo estado y ubicacion
                $ult_estado = $em->getRepository(EstadoactoadministrativoHasActoadministrativo::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));
                $orm_estado = $em->getRepository(Estadoactoadministrativo::class)->find($ult_estado->getEstadoactoadministrativoIdestado());
                $id_estado = $orm_estado->getIdestado();

                //busco ultima ubicacion
                $ult_movimiento = $em->getRepository(Movimiento::class)->findOneBy(array('actoadministrativoIdactoadministrativo' => $id), array('fechacarga' => 'desc'));

                if ($ult_movimiento) {
                    $idAreaOrigen = $ult_movimiento->getAreaIdareaorigen()->getIdArea();
                    $idAreaDestino = $ult_movimiento->getAreaIdareadestino()->getIdArea();
                    $orm_area = $em->getRepository(Area::class)->find($idAreaDestino);
                    $ultima_ubicacion = $orm_area->getIdarea();

                    //desde donde fue a ultima ubicacion
                    $orm_area = $em->getRepository(Area::class)->find($idAreaOrigen);
                    $origen = $orm_area->getIdarea();
                    // $fecha_ubi = $ult_movimiento->getFechamovimiento()->format("d-m-Y");

                    if (($ultima_ubicacion == 1 || $ultima_ubicacion == 5) && $origen == 2) { //exp que esten en privada o dpcyri y origen sea ue (pq les cargo el mov), pero con cualquier estado
                        $array_idActos[$i]['idActo'] = $unacto->getIdactoadministrativo();
                        $i++;
                    }
                }
            }
        }
        $datosActo = new DatosActoAdministrativo($em);

        //completo datos de los actos
        for ($i = 0; $i < count($array_idActos); $i++) {

            $id = $array_idActos[$i]['idActo'];
            $arraux = $datosActo->getActoPorId($id);
            $arr_result[$i] = $arraux[0];
        }
        if ($form->isSubmitted()) {

            if ($form->get('filtrar')->isClicked()) {

                if (!$form['fechaDesde']->getData() || !$form['fechaHasta']->getData()) {

                    $mensaje_txt = "Para Filtrar debe ingresar un rango válido de fecha";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesParaDictaminar.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }
                $arr_result_rango = array();
                $fdesde = $form['fechaDesde']->getData();

                $fhasta = $form['fechaHasta']->getData();
                $x = 0;
                for ($i = 0; $i < count($arr_result); $i++) {
                    $fechacompara = new \DateTime($arr_result[$i]['fechacarga']);

                    if ($fechacompara >= $fdesde && $fechacompara <= $fhasta) {
                        $arr_result_rango[$x] = $arr_result[$i];
                        $x++;
                    }
                }
                /*
                  for ($i = 0; $i < count($arr_result); $i++) {
                  if ($arr_result[$i]['fechacarga'] >= $fdesde && $arr_result[$i]['fechacarga'] <= $fhasta) {
                  $arr_result_rango[$x] = $arr_result[$i];
                  $x++;
                  }
                  }
                 */
                return $this->render('reportesParaDictaminar.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result_rango, 'totreg' => count($arr_result_rango), 'area' => $area));
            }

            if ($form->get('envio_para_dictaminar')->isClicked()) {

                if (!$request->request->get('actos')) {

                    $mensaje_txt = "Para Generar reporte debe incluir al menos un acto administrativo";
                    $session->getFlashBag()->add('error', $mensaje_txt);
                    return $this->render('reportesParaDictaminar.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
                }

                $arr_imprime = $request->request->get('actos');

                for ($i = 0; $i < count($arr_imprime); $i++) {
                    $arraux = $datosActo->getActoPorId($arr_imprime[$i]);
                    $arr_result_info[$i] = $arraux[0];
                }
                $pdf = new Reportes('L');
                $pdf->printReport_EnvioDesdeUE($arr_result_info);
                // limpiar el buffer de datos
                ob_end_clean();
                $pdf->Output("envioDesdeUE.pdf", 'I');
            }
        }

        return $this->render('reportesParaDictaminar.html.twig', array('form' => $form->createView(), 'array_result' => $arr_result, 'totreg' => count($arr_result), 'area' => $area));
    }

    // ------------------------------------------------------------------- 

    /**
     * @Route(path="/getArchivoAdjunto/{id}/descargar", name="get_archivo_adjunto")
     */
    public function getArchivoAdjunto(Request $request, $id): Response {

        //$session = $request->getSession();
        $em = $this->getDoctrine()->getManager('default');

        $archivo = $em->getRepository(Archivo::class)->find($id);
        $fileName = $archivo->getPath();
        $pathFile = $this->getParameter('informeFile_directory');

        $file = new File($pathFile . $fileName);
        return $this->file($file);

        //  echo $file;
        // die();
        //    echo $file;
        //   die();
        /*
          $tipo = mime_content_type($pathFile . "/2021-01/ESTADISTICA.xls");
          echo $tipo;
          die(); */

        /*  if (file_exists($pathFile . $fileName)) {
          $response =  new BinaryFileResponse($pathFile . $fileName);
          $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'fileName.pdf');
          return $response;
          }

          return new Response('file not found '.$pathFile . $fileName,404);
         */
    }

    // ------------------------------------------------------------------- 

    /**
     * @Route(path="/eliminarArchivoAdjunto/{id}/{idactoadministrativo}", name="eliminar_archivo_adjunto")
     */
    public function eliminarArchivoAdjunto(Request $request, $id, $idactoadministrativo): Response {

        $em = $this->getDoctrine()->getManager('default');
        $archivo = $em->getRepository(Archivo::class)->find($id);


        if ($archivo) {
            $fileName = $archivo->getPath();
            $pathFile = $this->getParameter('informeFile_directory');
            $filePath = $pathFile . $fileName;

            if (!empty($fileName) && file_exists($filePath)) {
                If (unlink($filePath)) {
                    echo "file was successfully deleted";
                    $em->remove($archivo);
                    $em->flush();
                } else {
                    echo "no se encontro el archivo";
                }
            }
        }
        return $this->redirectToRoute('ver_acto', array('idactoadministrativo' => $idactoadministrativo));
    }

}
