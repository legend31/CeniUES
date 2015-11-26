<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Resultadoevaluacion;
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
     * @Route("/listaalumnos", name="listaalumno")
     */
    public function listaAlumno(){
        return $this->render('AppBundle:reportes:listadoalumnos.html.twig');
    }
    /**
     * @Route("/notas/{id}", name="notas")
     */
    /*public function notasAlumnoAction($id){
        $em=$this->getDoctrine()->getManager();
        $eva=$em->getRepository('AppBundle:Evaluacion')->find($id);
        $detalle=$em->getRepository('AppBundle:Detalleevaluacion')->find(6);

        $resultado=new Resultadoevaluacion();
        $resultado->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find("AA12000"));
        $resultado->setDetalleevaluaciondetalleevaluacion($detalle);
        $resultado->setEvaluacionevaluacion($eva);
        $resultado->setDescripcion("Prueba");
        $resultado->setNota(7);

        $em->persist($resultado);
        $em->flush();

        return new Response('Ingresado');
    }*/

}
