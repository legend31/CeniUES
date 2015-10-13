<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 12/10/2015
 * Time: 8:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Docente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluacionController extends Controller
{
    /**
     * @Route("/evaluaciones", name="evalhome")
     */
    public function evaluacionHomeAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $evaluaciones = $em->getRepository('AppBundle:Evaluacion')->findAll();

        if(!$evaluaciones)
        {
            throw $this->createNotFoundException('No se encontro ninguna evaluacion');
        }

        return new Response($this->container->get('templating')->render('AppBundle:evaluacion:evaluacionPrincipal.html.twig', array('evaluaciones'=>$evaluaciones)));
        //return $this->render('AppBundle:docente:gestionarDocente.html.twig');//return $this->render('AppBundle:docente:pdoc.html.twig');
    }
}