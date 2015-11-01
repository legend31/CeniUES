<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 14/10/2015
 * Time: 2:46 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportesController extends Controller
{
    /**
     * @Route("/Reportes", name="rhome")
     */
    public function modulosnivelesAction()
    {
        return $this->render('AppBundle:reportes:principalreporte.html.twig');

    }

    /**
     * @Route("/Ainscritos", name="ainscritos")
     */
    public function alumnosInscritosAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $alumnos = $em->getRepository('AppBundle:Alumno')->findAll();

        if(!$alumnos)
        {
            throw $this->createNotFoundException('No se encontro ningun docente');
        }
        return new Response($this->container->get('templating')->render('AppBundle:reportes:alumnosinscritos.html.twig', array('TituloPagina' => 'Alumnos inscritos', 'form' => $alumnos)));
        //$this->render('AppBundle:reportes:alumnosinscritos.html.twig');
    }
}