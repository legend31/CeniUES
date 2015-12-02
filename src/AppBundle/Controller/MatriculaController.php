<?php

namespace AppBundle\Controller;

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

class MatriculaController extends Controller
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
        if($form->isValid()) {
            $data = $form->getData();
            $m=$this->getDoctrine()->getRepository('AppBundle:Matricula')->matriculasOrdenadas($data['Carnet']);
            return $this->render('AppBundle:matricula:desmatricular.html.twig', array('mat' =>$m, 'formulario' => $form->createView()));
        }
        else
            return $this->render('AppBundle:matricula:desmatricular.html.twig',array('mat'=>'', 'formulario' => $form->createView()));
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
     * @Route("/alumnoinsertar",name="alumnoinsert")
     */
    public function alumnoInsertAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $duplicado=$em->getRepository('AppBundle:Alumno')->find($request->get("carnet"));
        //Validando el envio del formulario
        if($request->isMethod("POST")) {
            if($duplicado){
                $this->MensajeFlash('fracaso','Alumno ya esta registrado en CENIUES');
                return $this->redirectToRoute('antiguo');
            }
            else{
                $al = new Alumno();
                $al->setCarnetalumno(strtoupper($request->get("carnet")));
                $al->setPrimernombrealumno($request->get("primer_nombre"));
                $al->setPrimerapellidoalumno($request->get("primer_apellido"));
                $al->setSegundonombrealumno($request->get("segundo_nombre"));
                $al->setSegundoapellidoalumno($request->get("segundo_apellido"));
                $al->setFechanacimiento(new \DateTime($request->get("fecha_nacimiento")));
                $al->setDireccioncasa("xx");
                $al->setTelefonocasa("xx");
                $al->setPadrepadre($this->getDoctrine()->getRepository('AppBundle:Padre')->findOneBy(array('nombrepadre'=>$request->get('padre'))));
                $al->setResponsableresponsable($em->getRepository('AppBundle:Responsable')->findOneBy(array('nombreresponsable'=>$request->get("responsable"))));

                // Transformar la Edad
                $fecha=$al->getFechanacimiento()->format('Y-m-d H:i:s');
                $segundos=strtotime('now') - strtotime($fecha);
                //Para hacerlo dias
                $edad=intval($segundos/60/60/24/365);
                // ******************
                $al->setEdad($edad);
                //Creo el usuario
                $user=new Usuario();
                $user->setTipoUsuariotipoUsuario($em->getRepository('AppBundle:TipoUsuario')->find(1));
                $user->setNomusuario($request->get("carnet"));
                $user->setEmailusuario($request->get("email"));
                $user->setIsactive(1);
                //Cifra la contraseña
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($request->get("carnet"), $user->getSalt());
                $user->setPassword($password);

                $em->persist($al);
                $em->persist($user);
                $em->flush();
            }
            $this->MensajeFlash('exito','Alumno Ingresado exitosamente!');
            return $this->redirectToRoute('antiguo');
        }
        return $this->render('AppBundle:formularios:alumno-inline.html.twig');

    }

    /**
     * @Route("/padreInsertar",name="padreinsert")
     */
    public function padreInsertAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $padre=$em->getRepository('AppBundle:Padre')->findOneBy(array('nombrepadre'=>$request->get("nombreP")));
            if($padre)
            {
                $this->MensajeFlash('fracaso',"Padres ya se encuentran en sistema!");
                return $this->redirectToRoute('antiguo');
            }
            else {
                $p = new Padre();
                $p->setNombrepadre($request->get("nombreP"));
                $p->setLugartrabajop($request->get("trabP"));
                $p->setTelefonotrabajopadre($request->get("telP"));
                $p->setNombremadre($request->get("nombreM"));
                $p->setLugartrabajom($request->get("maTrab"));
                $p->setTelefonotrabajomadre($request->get("maTel"));

                $em->persist($p);
                $em->flush();
                if ($request->get("origen") == "padrenuevo")
                    return $this->redirectToRoute('antiguo');
                else
                    return $this->redirectToRoute('examencolocacion');
            }
        }
        return $this->redirectToRoute('antiguo');
    }
    /**
     * @Route("/responInsertar",name="responinsert")
     */
    public function responInsertAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $res=new Responsable();
            $res->setNombreresponsable($request->get("nombre"));
            $res->setParentesco($request->get("parentesco"));
            $res->setTelefono($request->get("tel"));

            $em->persist($res);
            $em->flush();
            if($request->get("origen")=="nuevo")
                return $this->redirectToRoute('antiguo');
            else
                return $this->redirectToRoute('examencolocacion');
        }
        return $this->render('AppBundle:formularios:responsable-inline.html.twig');
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
            $fechaActual=new \DateTime('now');
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha iniciado el modulo!");
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
        }
        return $this->render('AppBundle:formularios:matricula-nvo.html.twig');
    }
    /**
     * @Route("/matriculaantiguo",name="matantiguo")
     */
    public function matriculaAntiguaAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        $nivel=$em->getRepository('AppBundle:Nivel')->findAll();
        //Formulario
        if($request->isMethod("POST"))
        {
            $mat=$em->getRepository('AppBundle:Matricula')->verificarMatricula($request->get('carnet'),$request->get('recibo'));
            $fechaActual=new \DateTime('now');
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha iniciado el modulo!");
                return $this->redirectToRoute('matantiguo');
            }
            elseif($mat){
                $this->MensajeFlash('error',"Alumno/Recibo ya matriculado en modulo!");
                return $this->redirectToRoute('matantiguo');
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
                //$this->MensajeFlash('Matriculacion exitosa');
                /*if($request->get("origen")=="antiguo")
                    return $this->redirectToRoute('matantiguo');
                else
                    return $this->redirectToRoute('examencolocacion');*/
                $this->MensajeFlash('exito',"Alumno matriculado exitosamente!");
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
        $niveles=$em->getRepository('AppBundle:Nivel')->nivelesColocacion();
        $eva=$em->getRepository('AppBundle:Evaluacion')->findAll();
        if($request->isMethod("POST")){
            $mat=$em->getRepository('AppBundle:Matricula')->verificarMatricula($request->get('carnet'),$request->get('recibo'));
            $fechaActual=new \DateTime('now');
            $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechaActual);
            //Validando q haya un modulo o que el alumno no esta ya matriculado
            if(!$modulo){
                $this->MensajeFlash('error',"Aun no se ha iniciado el modulo!");
                return $this->redirectToRoute('examencolocacion');
            }
            elseif($mat){
                $this->MensajeFlash('error',"Alumno/Recibo ya matriculado en modulo!");
                return $this->redirectToRoute('examencolocacion');
            }
            else{
                //validar la matricula
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

    //Metodos Privados
    public function MensajeFlash($nombre,$mensaje){
        $this->get('session')->getFlashBag()->add(
            ''.$nombre,
            ''.$mensaje
        );
    }
    //Funciones privadas de Ingreso por Examen de colocacion
    private  function ingresarNotas($em,$carnet,$eva,$nota,$detalle){
        $alumno=$em->getRepository('AppBundle:Alumno')->findOneBy(array('carnetalumno'=>$carnet));
        //Creacion del resultado
        $resultado=new Resultadoevaluacion();
        $resultado->setAlumnoCarnetalumno($alumno);
        $resultado->setDetalleevaluaciondetalleevaluacion($detalle);
        $resultado->setEvaluacionevaluacion($eva);
        //la nota del formulario
        $resultado->setNota($nota);
        //Peristencia
        $em->persist($detalle);
        $em->persist($resultado);
        $em->flush();
    }
    private function crearDetalle($em,$n,$modulo){
        //Docente
        $docente=$em->getRepository('AppBundle:Docente')->find("DC00002");
        //Verificando el modulo

        $nivel=$em->getRepository('AppBundle:Nivel')->find($n);
        //creacion del detalle de evaluacion
        $resul=$em->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('docenteCarnetdocente'=>$docente,'modulomodulo'=>$modulo,'nivelnivel'=>$nivel));
        if($resul)
            return $resul;
        else{
            $detalle=new Detalleevaluacion();
            $detalle->setDocenteCarnetdocente($docente);
            $detalle->setModulomodulo($modulo);
            $detalle->setNivelnivel($nivel);
            //persistencia
            $em->persist($detalle);
            $em->flush();
            $resul=$em->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('docenteCarnetdocente'=>$docente,'modulomodulo'=>$modulo,'nivelnivel'=>$nivel));
            return $resul;
        }
    }
    private  function crearRecord($em,$eva,$request,$modulo){
        $n=$request->get('nivel');
        for($i=1;$i<$n;$i++){
            $detalle=$this->crearDetalle($em,$i,$modulo);
            foreach($eva as $evaluaciones){
                $this->ingresarNotas($em,$request->get('carnet'),$evaluaciones,$request->get('nota'),$detalle);
            }
        }
    }
}
