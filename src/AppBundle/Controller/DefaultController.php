<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Route("/admin/principal", name="principal")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
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
     * @Route("/record",name="record")
     */
    public function recordAction(){
        /*$recodA=$this->getDoctrine()->getRepository('AppBundle:Recordalumno')->find(1);
        $record=$this->getDoctrine()->getRepository('AppBundle:Record')->find(1);
        var_dump($record->getNivelnivel());*/
        $n=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find(1);
        $s=$this->getDoctrine()->getRepository('AppBundle:Seccion')->find(1);
        //$s->getIdseccion()
        $a=$n->getSeccionseccion()->toArray();
        foreach($a as $ar){
            echo "<br>".$ar->getIdseccion();
        }
        return new Response();
    }


    //Funcion encargada de realizar la redireccion a las paginas principales para cada tipo usuario
    /**
     * @Route("/control", name="control_redirect")
     */
    public function controlRedirectAction(){
        if(true == $this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRADOR')){
            return $this->redirectToRoute("principal");
        }else{
            if(true == $this->get('security.authorization_checker')->isGranted('ROLE_DOCENTE')){
                return $this->redirectToRoute("docprincipal");
            }else{
                return $this->redirectToRoute("login");
            }
        }
    }
}
