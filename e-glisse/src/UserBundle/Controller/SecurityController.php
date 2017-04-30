<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;

class SecurityController extends Controller
{
    /**
     * @Route("/register")
     */
    public function resgiterAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createFormBuilder(new User())
            ->add("username")
            ->add("firstname")
            ->add("lastname")
            ->add("email")
            ->add("password")
            ->add("submit", SubmitType::class, array('label' => 'Inscription'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $user = $form->getData();
            $user->setPassword($user->getPassword());
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("home");
        }


        return $this->render('UserBundle:Security:register.html.twig', array(
            'inscription' => $form->createView()
        ));
    }

    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {
        // If user is already authenticated, we redirect him to home page
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('home');
        }

        // The service authentication_utils allows to get user name
        // and an error when the forms was already submitted but invalid
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('UserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));

    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('UserBundle:Security:logout.html.twig', array(
            // ...
        ));
    }

}
