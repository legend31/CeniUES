<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FechaController extends  Controller{
    /**
     * @Route("/fechasprincipal", name="fechaspricipal")
     */
    public function fechasAction(){
        return $this->render('AppBundle:admin/fechas:fechasPrincipal.html.twig');
    }

    /**
     * @Route("/fechamod", name="fechamod")
     */
    public function fechaMod(){
        return $this->render('AppBundle:admin/fechas:fechasModulos.html.twig');
    }

    /**
     * @Route("/fechaniv", name="fechaniv")
     */
    public function fechaNiv(){
        return $this->render('AppBundle:admin/fechas:fechasNiveles.html.twig');
    }

    /**
     * @Route("/fechageshoras", name="fechageshoras")
     */
    public function fechaGesHoras(){
      return $this->render('AppBundle:admin/fechas:fechasGesHoras.html.twig');
    }

    /**
     * @Route("/fechanotas", name="fechanotas")
     */
    public function fechaNotas(){
        return $this->render('AppBundle:admin/fechas:fechasIngresoNotas.html.twig');
    }
}