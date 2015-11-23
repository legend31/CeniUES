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

    /**
     * @Route("/notas",name="notas")
     */
    public function notasAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $eva=$em->getRepository('AppBundle:Evaluacion')->find(1);
        if($request->isMethod("POST")){
            //Alumno del formulario
            $alumno=$em->getRepository('AppBundle:Alumno')->findOneBy(array('carnetalumno'=>$request->get('carnet')));
            $docente=$em->getRepository('AppBundle:Docente')->find("DC00001");
            $modulo=$em->getRepository('AppBundle:Modulo')->find(1);
            //Obtengo el nivel del combo
            $nivel=$em->getRepository('AppBundle:Nivel')->find($request->get('nivel'));
            //creacion del detalle de evaluacion
            $detalle=new Detalleevaluacion();
            $detalle->setDocenteCarnetdocente($docente);
            $detalle->setModulomodulo($modulo);
            $detalle->setNivelnivel($nivel);
            //Creacion del resultado
            $resultado=new Resultadoevaluacion();
            $resultado->setAlumnoCarnetalumno($alumno);
            $resultado->setDetalleevaluaciondetalleevaluacion($detalle);
            $resultado->setEvaluacionevaluacion($eva);
            $resultado->setNota(7);
            //Peristencia
            $em->persist($resultado);
            $em->flush();
        }

        //var_dump($this->get('session')->get("_security_default"));
        return new Response('Insertado');

    }
}