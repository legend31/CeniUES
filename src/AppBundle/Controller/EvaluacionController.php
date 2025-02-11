<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 12/10/2015
 * Time: 8:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Docente;
use AppBundle\Entity\Evaluacion;
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
        $em = $this->getDoctrine()->getManager();
        $evaluaciones = $em->getRepository('AppBundle:Evaluacion')->findAll();

        if(!$evaluaciones)
        {
            return $this->render('AppBundle:evaluacion:evaluacionPrincipal.html.twig', array('evaluaciones'=>null));
        }
        /*$ponder = 0;
        foreach($evaluaciones as $Objeto => $ponder) {
            echo $Objeto . " contiene ";
        }*/
        //var_dump($ponder);

        //return $this->render('AppBundle:evaluacion:evalPrincipal.html.twig');
        return $this->render('AppBundle:evaluacion:evaluacionPrincipal.html.twig', array('evaluaciones'=>$evaluaciones));
    }

    /**
     * @Route("/newEval", name="agreval")
     */
    public function agregarEvaluaciónAction()
    {
        $evaluacion= new Evaluacion();

        $form = $this->createFormBuilder($evaluacion)
            ->add('idevaluacion','text',array('label' => 'ID evaluacion'))
            ->add('nombreevaluacion','text',array('label' => 'Titulo de la evaluacion'))
            ->add('ponderacion','text',array('label' => 'Ponderacion'))
            ->add('save', 'submit', array('label' => 'Agregar Evaluación'))
            ->getForm();

        $html = $this->container->get('templating')->render('AppBundle:evaluacion:agregarE.html.twig', array('TituloPagina' => 'Agregar Evaluacion', 'form' => $form->createView()));

        return new Response($html);
    }
}