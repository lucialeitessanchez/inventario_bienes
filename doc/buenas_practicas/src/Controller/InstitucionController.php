<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\ruinstituciones\Institucion;
use App\Entity\ruinstituciones\ComisionDirectiva;
use App\Entity\ruinstituciones\AutoridadRui;

/**
 * @Route(path="/institucion")
 */
class InstitucionController extends AbstractController {

    /**
     * @Route(path="/institucionPorLoc/{locId}", name="getInstitucionPorLoc")
     */
    // -------------------------------------------------------------------

    public function institucionPorLocAction($locId) {

        $arrayInstituciones = array();

        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');

        $arr_orm_inst = $em_instituciones->getRepository(Institucion::class)->findBy(array('localidad' => $locId), array('instNom' => 'ASC'));


        if ($arr_orm_inst) {
            foreach ($arr_orm_inst as $item) {
                if ($item->getEstadoReg() != 3) {
                    $arrayInstituciones[] = array(
                        'id' => $item->getInstId(),
                        'text' => $item->getInstNom()
                    );
                }
            }
        }
        return new JsonResponse($arrayInstituciones);
    }

    // -------------------------------------------------------------------

    /**
     * @Route(path="/datosInstitucion/{idInstitucion}", name="getDatosInstitucion")
     */
    // -------------------------------------------------------------------

    public function datosInstitucionAction($idInstitucion) {

        $datosInstitucion = array();

        //   $em = $this->getDoctrine()->getManager();
        $em_instituciones = $this->getDoctrine()->getManager('ruinstituciones');


        //$arr_orm_inst = $em->getRepository(Institucion::class)->find($idInstitucion);
        $arr_orm_inst = $em_instituciones->getRepository(Institucion::class)->getDatosInstitucion($idInstitucion);

        if ($arr_orm_inst) {
            $datosInstitucion['instNom'] = $arr_orm_inst[0]->getInstNom();
            $datosInstitucion['instNroRong'] = $arr_orm_inst[0]->getInstNroRong();
            $datosInstitucion['instDirCalle'] = $arr_orm_inst[0]->getInstDirCalle();
            $datosInstitucion['instDirNro'] = $arr_orm_inst[0]->getInstDirNro();
            $datosInstitucion['instTelefono'] = $arr_orm_inst[0]->getInstTelefono();
            $datosInstitucion['nroSipaf'] = $arr_orm_inst[0]->getInstNroSipaf();

            $arr_orm_comDirectiva = $em_instituciones->getRepository(ComisionDirectiva::class)->findBy(array('institucion' => $idInstitucion), array('comDirFecFin' => 'DESC'));

            if (count($arr_orm_comDirectiva) > 0) {

                $datosInstitucion['comdirFecIni'] = $arr_orm_comDirectiva[0]->getComDirFecIni()->format('d-m-Y');
                $datosInstitucion['comdirFecFin'] = $arr_orm_comDirectiva[0]->getComDirFecFin()->format('d-m-Y');

                $arr_orm_autoridades = $em_instituciones->getRepository(AutoridadRui::class)->findBy(array('comisionDirectiva' => $arr_orm_comDirectiva[0]->getComDirId()));
            }


            if (isset($arr_orm_autoridades)) {

                $i = 0;
                foreach ($arr_orm_autoridades as $autoridad) {
                    $arr_auto[$i]['apenom'] = $autoridad->getAutApe() . " " . $autoridad->getAutNom();
                    $arr_auto[$i]['documento'] = $autoridad->getAutDoc();
                    $arr_auto[$i]['cargo'] = $autoridad->getCargoAutoridad()->getCargoAutDesc();
                    $arr_auto[$i]['autTelefono'] = $autoridad->getAutTelefono();
                    $arr_auto[$i]['autCelular'] = $autoridad->getAutCelular();
                    $arr_auto[$i]['autMail'] = $autoridad->getAutMail();
                    $i++;
                }
                $datosInstitucion['autoridades'] = $arr_auto;
                //echo $cargoDes;
            }
        }

        return new JsonResponse($datosInstitucion);
    }

}
