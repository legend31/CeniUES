<?php

namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
use AppBundle\Entity\Modulo;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Record;
use AppBundle\Entity\Usuario;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends DSIController
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
     */
    public function principalAction(){
        /*$user = $this->get('security.token_storage')->getToken()->getUser();
        $tipoUsuario = $user->getTipoUsuariotipoUsuario()->getIdtipoUsuario();
        if($tipoUsuario == 1) {*/
            return $this->render('AppBundle:admin:vPrincipal.html.twig');
        /*}
        else if($tipoUsuario == 2 ) {
            return $this->render('AppBundle:admin:vPrincipal.html.twig');
        }
        else if($tipoUsuario == 3 ) {
            return $this->render('AppBundle:docente:pdoc.html.twig');
        }*/
    }

    /**
     * @Route("/doc/principal", name="dprincipal")
     */
    public function principalDocenteAction(){
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

    //FUNCION ENCARGADA DE REALIZAR EL REDIRECCIONAMIENTO A LA PANTALLA PRINCIPAL PARA C/U DE LOS USUARIOS
    /**
     * @Route("/control", name="control_redirect")
     */
    public function controlRedirectAction(){
        if(true == $this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRADOR')){
            return $this->redirectToRoute("principal");
        }else{
            if(true == $this->get('security.authorization_checker')->isGranted('ROLE_DOCENTE')){
                return $this->redirectToRoute('dprincipal');
            }else{
                return $this->redirectToRoute("login");
            }
        }
    }
    /**
     * @Route("buscarM")
     */
    public  function buscarM(){
       $f=$this->validarMatricula();
        var_dump($f);
        return new Response();
    }
    public function validarMatricula(){
        $max=1;
        $record=$this->getDoctrine()->getRepository('AppBundle:Record')->findAll();
        foreach($record as $r){
            //Obtengo el record
            $rA=$r->getRecordalumnorecordalumno();
            if($rA->getAlumnoCarnetalumno()->getCarnetalumno()=='BC11023'&&$rA->getNotafinal()>=7){
                //Divido el Nivel para saber cual es
                $n=explode("Nivel ",$r->getNivelnivel()->getNombrenivel());
                //Conoaco el max nivel
                if($n[1]>=$max)
                    $max=$n[1];
            }
        }
        return $max;
    }
}
