<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndendControllerController extends Controller
{
    /**
     * @Route("/SeeOders")
     */
    public function SeeOdersAction()
    {
        return $this->render('AdminBundle:IndendController:see_oders.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/DeleteOders")
     */
    public function DeleteOdersAction()
    {
        return $this->render('AdminBundle:IndendController:delete_oders.html.twig', array(
            // ...
        ));
    }

}
