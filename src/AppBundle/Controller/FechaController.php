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
}