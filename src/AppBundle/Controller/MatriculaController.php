<?php

namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Matricula;
use AppBundle\Entity\Alumno;
use AppBundle\Entity\Modulo;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Padre;
use AppBundle\Entity\Responsable;
use AppBundle\Entity\Resultadoevaluacion;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatriculaController extends DSIController
{
    /**
     * @Route("/desma",name="desma")
     */
    public function desmatriculaAction(Request $request)
    {
        $form=$this->createFormBuilder()
            ->add('Carnet','search')
            ->add('Buscar','submit')
            ->getForm();
        $form->handleRequest($request);
        $m=$this->getDoctrine()->getRepository('AppBundle:Matricula')->findBy(array('esactivo'=>1),array('nivelnivel'=>'ASC'));
        if($form->isValid()) {
            $data = $form->getData();
            $m=$this->getDoctrine()->getRepository('AppBundle:Matricula')->matriculasOrdenadas($data['Carnet']);
            return $this->render('AppBundle:matricula:desmatricular.html.twig', array('mat' =>$m, 'formulario' => $form->createView()));
        }
        else
            return $this->render('AppBundle:matricula:desmatricular.html.twig',array('mat'=>$m, 'formulario' => $form->createView(),'activos'=>1));
    }
    /**
     * @Route("/desmatricular/{d}",name="des")
     */
    public function desmatricularAction(Request $request,$d)
    {
        $em=$this->getDoctrine()->getManager();
        $mat=$em->getRepository('AppBundle:Matricula')->find($d);
        $mat->setEsactivo(0);
        $em->flush();
        //MensajeFlash
        $this->MensajeFlash('exito','Desmatriculacion exitosa!');
        return $this->redirectToRoute('desma');
    }

    /**
     * @Route("/matriculanuevo",name="matnuevo")
     */
    public function matriculaNuevoAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        //Formulario
        if($request->isMethod("POST"))
        {
            $mat=$em->getRepository('AppBundle:Matricula')->verificarMatricula($request->get('carnet'),$request->get('recibo'));
            $fechaActual=new \DateTime('now',new \DateTimeZone('America/El_Salvador'));
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha Configurado un Nuevo Modulo!");
                return $this->redirectToRoute('matnuevo');
            }
            elseif($mat){
                $this->MensajeFlash("error","Alumno/Recibo ya han sido matriculados");
                return $this->redirectToRoute('matnuevo');
            }
            else {
                $mat = new Matricula();
                //Buzo con el formato de la fecha
                $mat->setFechamatricula(new \DateTime($request->get("fecha"), new \DateTimeZone("America/El_Salvador")));
                $mat->setNumerorecibo($request->get('recibo'));
                $mat->setEsactivo(1);
                $mat->setNivelnivel($em->getRepository('AppBundle:Nivel')->find(1));
                $mat->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find($request->get('carnet')));
                //Perisistencia
                $em->persist($mat);
                $em->flush();
                $this->MensajeFlash('exito',"Alumno ha sido matriculado");
                return $this->redirectToRoute('matnuevo');
            }
            var_dump($modulo);
            new Response();
        }
        return $this->render('AppBundle:formularios:matricula-nvo.html.twig');
    }
    /**
     * @Route("/matriculaantiguo",name="matantiguo")
     */
    public function matriculaAntiguaAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        //$nivel=$em->getRepository('AppBundle:Nivel')->findAll();
        $nivel=$this->obtenerNivelesActivos();
        //Formulario
        if($request->isMethod("POST"))
        {
            $mat=$em->getRepository('AppBundle:Matricula')->verificarMatricula($request->get('carnet'),$request->get('recibo'));
            $fechaActual=new \DateTime('now',new \DateTimeZone('America/El_Salvador'));
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha Configurado un Nuevo Modulo!");
                return $this->redirectToRoute('matantiguo');
            }
            elseif($mat){
                $this->MensajeFlash('error',"Alumno/Recibo ya matriculado en modulo!");
                return $this->redirectToRoute('matantiguo');
            }
            elseif(!$em->getRepository('AppBundle:Matricula')->findOneBy(array('alumnoCarnetalumno'=>$em->getRepository('AppBundle:Alumno')->find($request->get('carnet'))))){
                $this->MensajeFlash('error',"Alumno nunca ha cursado niveles en CENIUES.Registrelo como nuevo Alumno");
                return $this->redirectToRoute('matantiguo');
            }
            else{
                $nivel=$em->getRepository('AppBundle:Nivel')->find($request->get('nivel'));
                $n=explode("Nivel ",$nivel->getNombrenivel());
                //Correcion si ya paso el nivel 1
                if($n[1]>1)
                    $n[1]=$n[1]+1;
                if($n[1]==$this->validarMatricula()){
                    $mat=new Matricula();
                    //Buzo con el formato de la fecha
                    $mat->setFechamatricula(new \DateTime($request->get("fecha")));
                    $mat->setNumerorecibo($request->get('recibo'));
                    $mat->setEsactivo('1');
                    $mat->setNivelnivel($em->getRepository('AppBundle:Nivel')->find($request->get('nivel')));
                    $mat->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find($request->get('carnet')));
                    //Perisistencia
                    $em->persist($mat);
                    $em->flush();
                    $this->MensajeFlash('exito',"Alumno matriculado exitosamente!");
                    return $this->redirectToRoute('matantiguo');
                }
                $this->MensajeFlash('error',"Por favor Matricular este Alumno en el Nivel ".$n[1]);
                return $this->redirectToRoute('matantiguo');
            }
        }
        return $this->render('AppBundle:formularios:matricula.html.twig',array('niveles'=>$nivel));
    }
    /**
     * @Route("/ingresoporcolocacion",name="examencolocacion")
     */
    public function examenColocacionAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        //Para el combo del formulario
        //$niveles=$em->getRepository('AppBundle:Nivel')->nivelesColocacion();
        $niveles=$this->obtenerNivelesActivos();
        $eva=$em->getRepository('AppBundle:Evaluacion')->findAll();
        if($request->isMethod("POST")){
            $alum=$em->getRepository('AppBundle:Alumno')->find($request->get('carnet'));
            $mat=$em->getRepository('AppBundle:Matricula')->findOneBy(array('alumnoCarnetalumno'=>$alum));
            $fechaActual=new \DateTime('now');
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha Configurado un Nuevo Modulo!");
                return $this->redirectToRoute('examencolocacion');
            }
            elseif($mat){
                $this->MensajeFlash('error',"Alumno ya ha cursado niveles en CENIUES");
                return $this->redirectToRoute('examencolocacion');
            }
            elseif($em->getRepository('AppBundle:Matricula')->findOneBy(array('numerorecibo'=>$request->get('recibo')))){
                $this->MensajeFlash('error',"Ese recibo ya ha sido usado en CENIUES");
                return $this->redirectToRoute('examencolocacion');
            }
            else{
                $mat=new Matricula();
                //Buzo con el formato de la fecha
                $mat->setFechamatricula(new \DateTime($request->get("fecha")));
                $mat->setNumerorecibo($request->get('recibo'));
                $mat->setEsactivo('1');
                $mat->setNivelnivel($em->getRepository('AppBundle:Nivel')->find($request->get('nivel')));
                $mat->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find($request->get('carnet')));
                //Perisistencia
                $em->persist($mat);
                $em->flush();
                //crear el record de estudiante
                $this->crearRecord($em,$eva,$request,$modulo);
                $this->MensajeFlash('exito',"Matriculacion Exitosa");
                return $this->redirectToRoute('examencolocacion');
            }
        }
        return $this->render('AppBundle:alumno:antiguoAlumnotabs.html.twig',array('niveles'=>$niveles));
    }
    //JSon que uso para el Autocompletado
    /**
     * @Route("/json")
     */
    public function jsonAction(){
        $padres=$this->getDoctrine()->getRepository('AppBundle:Alumno')->findAll();
        foreach($padres as $p){
            $pp[]=$p->getCarnetalumno();
        }
        echo json_encode($pp);
        //var_dump($pp);
        return new Response();
    }
    /**
     * @Route("/jsonResponsable")
     */
    public function jsonResponsableAction(){
        $respon=$this->getDoctrine()->getRepository('AppBundle:Responsable')->findAll();
        foreach($respon as $res){
            $pp[]=$res->getNombreresponsable();
        }
        echo json_encode($pp);
        return new Response();
    }
    /**
     * @Route("/jsonPadre")
     */
    public function jsonPadreAction(){
        $padres=$this->getDoctrine()->getRepository('AppBundle:Padre')->findAll();
        foreach($padres as $pa){
            $pp[]=$pa->getNombrepadre();
        }
        echo json_encode($pp);
        return new Response();
    }
    /**
     * @Route("/jsonMatricula")
     */
    public function jsonMatAction(){
        $matricula=$this->getDoctrine()->getRepository('AppBundle:Matricula')->findBy(array('esactivo'=>1));
        foreach($matricula as $mat){
            $mm[]=$mat->getAlumnoCarnetalumno()->getCarnetalumno();
        }
        echo json_encode($mm);
        return new Response();
    }
    /**
     * @Route("/fecha")
     */
    public function FechaAction(){
        $fecha="1992-03-31 00:00:00";
        $segundos=strtotime('now') - strtotime($fecha);
        $diferencia_dias=intval($segundos/60/60/24/365);
        echo "La cantidad de días entre el ".$fecha." y hoy es <b>".$diferencia_dias."</b>";
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
