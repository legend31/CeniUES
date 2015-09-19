<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }


    /**
     * @Route("/principal", name="principal")
     */
    public function principalAction(){
        return $this->render('AppBundle:admin:vPrincipal.html.twig');
    }
    /**
     * @Route("/fer")
     */
    public function ferAction(){
        return new Response('Hola Fer');
    }
    /**
     * @Route("/prueba", name="prueba")
     */
    public function pruebaAction(){
        return $this->render("AppBundle:admin:prueba_principal.html.twig");
    }
}
