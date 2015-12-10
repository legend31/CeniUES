<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Alumno;
use AppBundle\Entity\Clase;
use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Nivel;
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
    public function ingresarNotas(Request $request){
        $rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
        $niv = $rep->findAll();
        $mat = $this->getDoctrine()->getRepository('AppBundle:Matricula');
        if($request->isMethod('POST')){
            $nivel = $request->get('snivel');
            $horario = $request->get('sclase');
            $al= $mat->listadoAlumnos($nivel,$horario);
            //$repres = $this->getDoctrine()->getRepository('AppBundle:Resultadoevaluacion');
            //$this->mensajeflash('Modulo actualizado correctamente'.$nivel);
            return $this->render('AppBundle:notas:igresarNotas.html.twig', array("alumnos" => $al,"niveles"=>$niv));
        }else{
            return $this->render("AppBundle:notas:igresarNotas.html.twig",array("niveles"=>$niv));
        }

    }

    /**
     * @Route("/consultarnotas", name="consultarnotas")
     */
    public function consultarNotas(Request $request){
        //return $this->render('AppBundle:notas:consultarNotas.html.twig');
            /*$rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
            $niv = $rep->findAll();
            $mat = $this->getDoctrine()->getRepository('AppBundle:Matricula');
            $ev = $this->getDoctrine()->getRepository('AppBundle:Evaluacion')->findAll();
            if($request->isMethod('POST')){
                $nivel = $request->get('snivel');
                $horario = $request->get('sclase');
                $al= $mat->prueba($nivel,$horario);


            }
            return $this->render("AppBundle:notas:igresarNotas.html.twig",array("niveles"=>$niv));*/
        $niv = $this->getDoctrine()->getRepository('AppBundle:Nivel')->findAll();
        if($request->isMethod('POST')){
            $nivel = $request->get('snivel');
            $horario = $request->get('sclase');
            $al= $this->getDoctrine()->getRepository('AppBundle:Matricula')->prueba($nivel,$horario);
            $alComparar=new Alumno();
            $n=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find($nivel);
            $det=$this->getDoctrine()->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('nivelnivel'=>$n));
            $res=$this->getDoctrine()->getRepository('AppBundle:Resultadoevaluacion')->findBy(array('detalleevaluaciondetalleevaluacion'=>$det));
            return $this->render("AppBundle::notas.html.twig",array('alumnos'=>$res,'al'=>$alComparar,'niveles'=>''));
        }
        return $this->render("AppBundle::notas.html.twig",array('alumnos'=>'','al'=>'','niveles'=>$niv));
    }



    private function mensajeflash($m){
        $this->get('session')->getFlashBag()->add('mensaje',''.$m);
    }


    //FUNCION ENCARGADA DE AUTOCOMPLETAR UN SELECT EN BASE A OTRO
    /**
     * @Route("/js", name="js")
     */
    public function javascriptSelect(Request $request){
        if($request->isMethod('POST')){
            $rep2 = $this->getDoctrine()->getRepository('AppBundle:Clase');
            $idpasado = $request->get('idniv');
            $clase = $rep2->findBy(array("nivelnivel"=>$idpasado));
            //$c = array();
            foreach($clase as $clas){
                //array_push($c,$clas->getHorario());
                $c["horario"]=$clas->getHorario()->format("h:i:s");
            }
            echo json_encode($c);
            //$this->mensajeflash(date("Y-m-d(h:i:s)",$c["horario"]));
            return new Response();

        }
    }
}