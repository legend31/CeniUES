<?php
namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
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

class NotasController extends DSIController{
    /**
     * @Route("/notasprincipal", name="notasprincipal")
     */
    public function notasPrincipal(){
        return $this->render("AppBundle:notas:notasPrincipal.html.twig");
    }

    /**
     * @Route("/ingresarnotas", name="ingresarnotas")
     */
/*
    public function ingresarNotas(Request $request){
        $rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
        $niv = $rep->findAll();
        $mat = $this->getDoctrine()->getRepository('AppBundle:Matricula');
        $ev = $this->getDoctrine()->getRepository('AppBundle:Evaluacion')->findAll();
        if($request->isMethod('POST')){
            $nivel = $request->get('snivel');
            $horario = $request->get('sclase');
            $al= $mat->listadoAlumnos($nivel,$horario);
            //var_dump($al);
            $repres = $this->getDoctrine()->getRepository('AppBundle:Resultadoevaluacion');
            $arrnotas = new \ArrayObject();
            //$prueba = $repres->getresevaluaciones('AA12000');
            foreach ($al as $auxal ) {
                $a=(object)$auxal;
                //$notas = $repres->getresevaluaciones($a->carnetalumno);
                $notas = $repres->findBy(array('alumnoCarnetalumno'=>$a->carnetalumno));
                $ob = (object)$notas;
                if($ob->nota == null){
                    $notas->nota=0;
                }
                $arrnotas->append($notas);
                /*if(!empty($notas)){
                    foreach($notas as $n) {
                        $obnotas = new \stdClass();
                        $ob = (object)$n;
                        //$obnotas->evaluacion = $ob->nombreevaluacion;
                        if($ob->nota==null){
                            $ob->nota =0;
                        }else {
                            $obnotas->nota = $ob->nota;
                        }
                        $arrnotas->append($obnotas);
                    }
                }*/
  /*          }
            return $this->render('AppBundle:notas:igresarNotas.html.twig', array("alumnos" => $al,"niveles"=>$niv,"notas"=>$arrnotas,"evaluacion"=>$ev));
            //return $this->render('AppBundle:notas:igresarNotas.html.twig', array("alumnos" => $al,"niveles"=>$niv,"notaalum"=>$notasevaluacion));
        }else{
            return $this->render("AppBundle:notas:igresarNotas.html.twig",array("niveles"=>$niv));
        }
        return $this->render("AppBundle:notas:igresarNotas.html.twig",array("niveles"=>$niv));
*/
    public function ingresarNotasAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $niv = $this->obtenerNivelesActivos();
        $alumnos=$this->getDoctrine()->getRepository('AppBundle:Alumno')->findAll();
        //Si se envio el formulario
        if($request->isMethod('POST')){
            //Si se hace la consulta
            if($request->request->has('con'))
            {
                $n=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find($request->get('snivel'));
                $det=$this->getDoctrine()->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('nivelnivel'=>$n));
                $res=$this->getDoctrine()->getRepository('AppBundle:Resultadoevaluacion')->findBy(array('detalleevaluaciondetalleevaluacion'=>$det,'alumnoCarnetalumno'=>$request->get('carnet')));
                if($res) {
                    $alComparar=new Alumno();
                    return $this->render("AppBundle::notaslista.html.twig", array('alumnos' => $res, 'al' => $alComparar, 'niveles' => $niv,
                        'alumnosL'=>$alumnos,'selectedN'=>$request->get('snivel'),'selectedA'=>$request->get('carnet')));
                }
            }
            elseif($request->request->has('mod')){
                $keys=$request->request->keys();
                foreach($keys as $k){
                    //Verifico si es una de las llaves q busco
                    if (strpos($k,'n-') !== false) {
                       $aux[]=explode("-",$k);
                        $llaves[]=$k;
                    }
                }
                $i=0;
                $error=0;
                foreach($aux as $a){
                    $alumno=$em->getRepository('AppBundle:Alumno')->find($aux[0][4]);
                    $det=$em->getRepository('AppBundle:Detalleevaluacion')->find($aux[0][2]);
                    $eva=$em->getRepository('AppBundle:Evaluacion')->find($aux[$i][1]);
                    //Obtengo el resultado
                    $resultado=$this->getDoctrine()->getRepository('AppBundle:Resultadoevaluacion')->findOneBy(array('evaluacionevaluacion'=>$eva,'alumnoCarnetalumno'=>$alumno,'detalleevaluaciondetalleevaluacion'=>$det));
                    if($request->get($llaves[$i])>=0.0&&$request->get($llaves[$i])<=10.00){
                    $resultado->setNota($request->get($llaves[$i]));
                    $em->flush();
                    $i++;
                    }
                    else
                        $error++;
                }
                if($error==0)
                    $this->MensajeFlash('exito','Modificacion Exitosa');
                else
                    $this->MensajeFlash('error','Ingrese notas entre 0  y 10!');
                return $this->redirectToRoute('ingresarnotas');
            }

        }
        return $this->render("AppBundle::notaslista.html.twig",array('alumnos'=>'','al'=>'','alumnosL'=>$alumnos,'niveles'=>$niv,'selectedN'=>'','selectedA'=>''));

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
    /**
     * @Route("/pruebaf", name="pruebaf")
     */
    public function pruebafAction(Request $request){
        $rep = $this->getDoctrine()->getRepository('AppBundle:Nivel');
        $niv = $rep->findAll();
        $mat = $this->getDoctrine()->getRepository('AppBundle:Matricula');
        $ev = $this->getDoctrine()->getRepository('AppBundle:Evaluacion')->findAll();
        if($request->isMethod('POST')){
            $nivel = $request->get('snivel');
            $horario = $request->get('sclase');
            $al= $mat->prueba($nivel,$horario);
            var_dump($al);
        }
        return $this->render("AppBundle:notas:igresarNotas.html.twig",array("niveles"=>$niv));
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
    private function modificarNotas(){

    }
}