<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Checkrequisitos;

/**
 * @Route(path="/requisitos")
 */
class CheckrequisitosController extends AbstractController {

    /**
     * @Route(path="/checklistRequisitos", name="getChecklistRequisitos")
     */
    // -------------------------------------------------------------------

    public function checklistRequisitosAction() {

        $arrayRequisitos = array();

        $em = $this->getDoctrine()->getManager();

        $arr_orm_requisitos = $em->getRepository(Checkrequisitos::class)->findAll();


        if ($arr_orm_requisitos) {
            foreach ($arr_orm_requisitos as $item) {
               
                    $arrayRequisitos[] = array(
                        'id' => $item->getIdcheckrequisitos(),
                        'text' => $item->getDetallerequisito()."-".$item->getValidopara()
                    );
               
            }
        }
        return new JsonResponse($arrayRequisitos);
    }

    // -------------------------------------------------------------------

   

}
