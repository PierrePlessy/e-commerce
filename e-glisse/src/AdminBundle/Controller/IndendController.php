<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Pannier;

class IndendController extends Controller
{
    /**
     * @Route("/seeOders", name="seeOders")
     */
    public function seeOdersAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $pannierRepo = $em->getRepository("AppBundle:Pannier");
        $panniers = $pannierRepo->findAll();

        return $this->render('AdminBundle:Indend:see_oders.html.twig', array(
            'panniers' => $panniers
        ));
    }

    /**
     * @Route("/deleteOders", name="deleteOders")
     */
    public function deleteOdersAction()
    {
        return $this->render('AdminBundle:Indend:delete_odres.html.twig', array(
            // ...
        ));
    }

}
