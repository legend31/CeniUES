<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModulosNivelesController extends Controller{

    /**
     * @Route("/modulosyniveles", name="gmyn")
     */
    public function modulosnivelesAction(){
        return $this->render('AppBundle:admin:gmodulosniveles/mynPrincipal.html.twig');

    }

    /**
     * @Route("/modulos", name="gmodulos")
     */
    public function gmodulosAction(){
        return $this->render('AppBundle:admin:gmodulosniveles/gmodulos.html.twig');
    }

}