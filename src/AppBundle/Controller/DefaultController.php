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
     * @Route("/listaalumnos", name="listaalumno")
     */
    public function listaAlumno(){
        return $this->render('AppBundle:reportes:listadoalumnos.html.twig');
    }

    /**
     * @Route("/pdf")
     */
    public function pdfAction(){
        $em=$this->getDoctrine()->getEntityManager();
        $alumno=$em->getRepository('AppBundle:Alumno')->findOneBy(array('carnetalumno'=>'bc11023'));
            //return $this->render('AppBundle:alumno:alumno-buscar.html.twig',array('al'=>$alumno));

        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('ceniues.pdf');
        return $pdfGenerator->displayForView('AppBundle::pdf.html.twig',array('al'=>$alumno));
        //return $this->render('AppBundle::pdf.html.twig',array('al'=>$alumno));
    }

}
