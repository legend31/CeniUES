<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Matricula;
use AppBundle\Entity\Alumno;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Padre;
use AppBundle\Entity\Responsable;
use AppBundle\Entity\Resultadoevaluacion;
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
        $this->MensajeFlash('Desmatriculacion exitosa!');
        return $this->redirectToRoute('desma');
            //return $this->render('AppBundle:matricula:desmatricular.html.twig',array('al'=>$em->getRepository('AppBundle:Alumno')->find($mat->getAlumnoCarnetalumno()),'mat' =>$mat,'formulario' => $form->createView()))
    }

    /**
     * @Route("/alumnoinsertar",name="alumnoinsert")
     */
    public function alumnoInsertAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        //Validando el envio del formulario
        if($request->isMethod("POST")) {
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

            $em->persist($al);
            $em->flush();
            if($request->get("origen")=="nuevo")
                return $this->redirectToRoute('antiguo');
            else
                return $this->redirectToRoute('examencolocacion');
        }
        return $this->render('AppBundle:formularios:alumno-inline.html.twig');

    }

    /**
     * @Route("/padreInsertar",name="padreinsert")
     */
    public function padreInsertAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $p=new Padre();
            $p->setNombrepadre($request->get("nombreP"));
            $p->setLugartrabajop($request->get("trabP"));
            $p->setTelefonotrabajopadre($request->get("telP"));
            $p->setNombremadre($request->get("nombreM"));
            $p->setLugartrabajom($request->get("maTrab"));
            $p->setTelefonotrabajomadre($request->get("maTel"));

            $em->persist($p);
            $em->flush();
            if($request->get("origen")=="padrenuevo")
                return $this->redirectToRoute('antiguo');
            else
                return $this->redirectToRoute('examencolocacion');
        }
        return $this->render('AppBundle:formularios:padre-inline.html.twig');
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
        $em=$this->getDoctrine()->getEntityManager();
        //Formulario
        if($request->isMethod("POST"))
        {
            $alumnos=$em->getRepository('AppBundle:Matricula')->findByalumnoCarnetalumno($request->get('carnet'));
            foreach ($alumnos as $item)
            {
                $item->setEsactivo(0);
            }
            $mat=new Matricula();
            //Buzo con el formato de la fecha
            $mat->setFechamatricula(new \DateTime($request->get("fecha"),new \DateTimeZone("America/El_Salvador")));
            $mat->setNumerorecibo($request->get('recibo'));
            $mat->setEsactivo(1);
            $mat->setNivelnivel($em->getRepository('AppBundle:Nivel')->find(1));
            $mat->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find($request->get('carnet')));
            //Perisistencia
            $em->persist($mat);
            $em->flush();
            return $this->redirectToRoute('antiguo');
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
            $alumnos=$em->getRepository('AppBundle:Matricula')->findByalumnoCarnetalumno($request->get('carnet'));
            foreach ($alumnos as $item)
            {
                $item->setEsactivo(0);
            }
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
            if($request->get("origen")=="antiguo")
                return $this->redirectToRoute('matantiguo');
            else
                return $this->redirectToRoute('examencolocacion');
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
            $this->crearRecord($em,$eva,$request);
            //$this->MensajeFlash('Matriculacion exitosa');
            return $this->redirectToRoute('examencolocacion');
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
     * @Route("/fecha")
     */
    public function FechaAction(){
        /*$fecha=new \DateTime(date("Y-m-d"));
        $f=date("Y-m-d");
        echo $f;
        return new Response();*/

        $fecha="1992-03-31 00:00:00";
        $segundos=strtotime('now') - strtotime($fecha);
        $diferencia_dias=intval($segundos/60/60/24/365);
        echo "La cantidad de días entre el ".$fecha." y hoy es <b>".$diferencia_dias."</b>";
        return new Response();
    }
    private function MensajeFlash($m){
        $this->get('session')->getFlashBag()->add(
            'mensaje',
            ''.$m
        );
    }
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
    private function crearDetalle($em,$n){
        $docente=$em->getRepository('AppBundle:Docente')->find("DC00002");
        $modulo=$em->getRepository('AppBundle:Modulo')->find(1);
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
    private  function crearRecord($em,$eva,$request){
        $n=$request->get('nivel');
        for($i=1;$i<$n+1;$i++){
            $detalle=$this->crearDetalle($em,$i);
            foreach($eva as $evaluaciones){
                $this->ingresarNotas($em,$request->get('carnet'),$evaluaciones,$request->get('nota'),$detalle);
            }
        }
    }
}
