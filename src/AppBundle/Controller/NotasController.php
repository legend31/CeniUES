<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Clase;
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
    public function consultarNotas(){
        return $this->render('AppBundle:notas:consultarNotas.html.twig');
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