<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Resultadoevaluacion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotasController extends Controller{
    /**
     * @Route("/notasprincipal", name="notasprincipal")
     */
    public function notasPrincipal(){
        return $this->render("AppBundle:notas:notasPrincipal.html.twig");
    }

    /**
     * @Route("/ingresarnotas", name="ingresarnotas")
     */
    public function ingresarNotas(){
        return $this->render("AppBundle:notas:igresarNotas.html.twig");
    }

    /**
     * @Route("/consultarnotas", name="consultarnotas")
     */
    public function consultarNotas(){
        return $this->render('AppBundle:notas:consultarNotas.html.twig');
    }
}