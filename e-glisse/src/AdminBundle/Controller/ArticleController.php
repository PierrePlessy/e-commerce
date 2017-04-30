<?php

namespace AdminBundle\Controller;

use Doctrine\DBAL\Types\StringType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/add", name="addArticle")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createFormBuilder(new Article())
            ->add("name")
            ->add("category")
            ->add("price")
            ->add("picture")
            ->add("length")
            ->add("width")
            ->add("thickness")
            ->add("description")
            ->add("submit", SubmitType::class, array('label' => 'Add'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $article = $form->getData();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("listArticles");
        }

        return $this->render('AdminBundle:Article:add.html.twig', array(
            'addArticle' => $form->createView()
        ));
    }

    /**
     * @Route("/articles", name="listArticles")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $articles = $articleRepo->findAll();

        return $this->render('AdminBundle:Article:list.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteArticle")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $article = $articleRepo->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute("listArticles");
    }

    /**
     * @Route("/edit/{id}", name="editArticle")
     */
    public function editAction(Request $request ,$id)
    {
        //get the article
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $article = $articleRepo->find($id);

        //create form
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createFormBuilder(new Article())
            ->add("name")
            ->add("category")
            ->add("price")
            ->add("picture")
            ->add("length")
            ->add("width")
            ->add("thickness")
            ->add("description")
            ->add("submit", SubmitType::class, array('label' => 'Change'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $art = $form->getData();

            if(is_null($art->getName()) == 0){
                $article->setName($art->getName);
            }




            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("listArticles");
        }


        return $this->render('AdminBundle:Article:edit.html.twig', array(
            'editArticle' => $form->createView(),
            'article' => $article
        ));
    }

}
