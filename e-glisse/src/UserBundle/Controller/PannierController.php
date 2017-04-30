<?php

namespace UserBundle\Controller;

use AppBundle\Entity\Pannier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PannierController extends Controller
{
    /**
     * @return bool
     */

    private function createPannier(){
        if (!isset($_SESSION['pannier'])){
            $_SESSION['pannier']=array();
            $_SESSION['pannier']['idProduct'] = array();
            $_SESSION['pannier']['number'] = array();
            $_SESSION['pannier']['price'] = array();
            $_SESSION['pannier']['lock'] = false;
        }
        return true;
    }

    private function findArticle($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        return $articleRepo->find($id);
    }

    /**
     * @Route("/addElement/{id}", name="addElement")
     */
    public function addElementAction($id)
    {
        $article = $this->findArticle($id);

        if ($this->createPannier())// && !isVerrouille())
        {
            $positionProduct = array_search($article->getName(),  $_SESSION['pannier']['idProduct']);

            if ($positionProduct !== false)
            {
                $_SESSION['pannier']['number'][$positionProduct] += 1 ;
            }
            else
            {
                $amount = 1;
                array_push( $_SESSION['pannier']['idProduct'],$article->getName());
                array_push( $_SESSION['pannier']['number'],$amount);
                array_push( $_SESSION['pannier']['price'],$article->getPrice());
            }
        }

        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $articles = $articleRepo->findAll();

        return $this->render('UserBundle:Default:index.html.twig', array(
            'articles' => $articles
        ));

    }

    /**
     * @Route("/deleteElement/{id}", name="deleteElement")
     */
    public function deleteElementAction($id)
    {

        if ($this->createPannier())// && !isVerrouille())
        {
            $tmp=array();
            $tmp['idProduct'] = array();
            $tmp['number'] = array();
            $tmp['price'] = array();
            $tmp['lock'] = $_SESSION['pannier']['lock'];

            for($i = 0; $i < count($_SESSION['pannier']['idProduct']); $i++)
            {
                if ($_SESSION['pannier']['idProduct'][$i] !== $id)
                {
                    array_push( $tmp['idProduct'],$_SESSION['pannier']['idProduct'][$i]);
                    array_push( $tmp['number'],$_SESSION['pannier']['number'][$i]);
                    array_push( $tmp['price'],$_SESSION['pannier']['price'][$i]);
                }
            }

            $_SESSION['pannier'] =  $tmp;

            unset($tmp);
        }

        return $this->displayAction();
    }

    /**
     * @Route("/validate", name="validate")
     */
    public function validateAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $pannier = new Pannier($_SESSION['pannier']);
        $em->persist($pannier);
        $em->flush();

        unset($_SESSION['pannier']);

        return $this->render('UserBundle:Pannier:validate.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/display")
     */
    public function displayAction()
    {
        $total=0;
        for($i = 0; $i < count($_SESSION['pannier']['idProduct']); $i++)
        {
            $total += $_SESSION['pannier']['number'][$i] * $_SESSION['pannier']['price'][$i];
        }

        $articles = array();
        for($i = 0; $i < count($_SESSION['pannier']['idProduct']); $i++)
        {
            $art = $this->findArticle($_SESSION['pannier']['idProduct'][$i]);
            $articles[] = $art;
        }

        return $this->render('UserBundle:Pannier:display.html.twig', array(
            'total' => $total,
            'articles' => $articles,
            'session' => $_SESSION['pannier']
        ));
    }

}
