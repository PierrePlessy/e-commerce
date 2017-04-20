<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityControllerController extends Controller
{
    /**
     * @Route("/resgiter")
     */
    public function resgiterAction()
    {
        return $this->render('UserBundle:SecurityController:resgiter.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('UserBundle:SecurityController:login.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('UserBundle:SecurityController:logout.html.twig', array(
            // ...
        ));
    }

}
