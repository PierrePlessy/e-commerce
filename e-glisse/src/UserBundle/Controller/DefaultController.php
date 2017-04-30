<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $articles = $articleRepo->findAll();

        return $this->render('UserBundle:Default:index.html.twig', array(
            'articles' => $articles
        ));

    }
}
