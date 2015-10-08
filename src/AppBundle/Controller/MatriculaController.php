<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Matricula;
use AppBundle\Entity\Alumno;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Padre;
use AppBundle\Entity\Responsable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatriculaController extends Controller
{
    /**
     * @Route("/desmatricular/{d}",defaults={"d" = 0},name="des")
     */
    public function desmatricularAction(Request $request,$d)
    {
        $em=$this->getDoctrine()->getManager();
        $form=$this->createFormBuilder()
            ->add('Carnet','search')
            ->add('Buscar','submit')
            ->getForm();
        $form->handleRequest($request);
        if($d>0){
            $mat=$em->getRepository('AppBundle:Matricula')->find($d);
            $mat->setEsactivo(0);
            $em->flush();
            //MensajeFlash
            $this->MensajeFlash('Desmatriculacion exitosa!');
            return $this->redirectToRoute('des');
        }
        if($form->isValid()) {
            $form->getData();
            $data = $form->getData();
            $al = $this->getDoctrine()->getRepository('AppBundle:Alumno')->find($data['Carnet']);
            /*if($al) {
                $fecha = $this->getDoctrine()->getRepository('AppBundle:Matricula')->fechaReciente($data['Carnet']);
                $m = $this->getDoctrine()->getRepository('AppBundle:Matricula')->matriculasReciente($fecha);
                return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al,'mat' =>$m, 'formulario' => $form->createView()));
            }
            else
                return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al,'mat' =>'', 'formulario' => $form->createView()));
            */
            //Reviso todas las matriculas de ese alumno
            $m=   $this->getDoctrine()->getRepository('AppBundle:Matricula')->findByalumnoCarnetalumno($data['Carnet']);
            foreach($m as $item)
            {
                //Reviso si alguna esta activa para asi mandarla
                if($item->getEsactivo()==1)
                {
                    $m=$item;
                    return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al,'mat' =>$m, 'formulario' => $form->createView()));
                }

            }
            //Si no tiene activa ninguna matricula
            $m=$this->getDoctrine()->getRepository('AppBundle:Matricula')->findOneByalumnoCarnetalumno($data['Carnet']);
            return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al,'mat' =>$m, 'formulario' => $form->createView()));
        }
        else
            return $this->render('AppBundle:matricula:desmatricular.html.twig',array('al'=>'', 'formulario' => $form->createView()));
    }

    /**
     * @Route("/alumnoinsertar",name="alumnoinsert")
     */
    public function alumnoInsertAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        //Validando el envio del formulario
        if($request->isMethod("POST")) {
            $al = new Alumno();
            $al->setCarnetalumno($request->get("carnet"));
            $al->setPrimernombrealumno($request->get("primer_nombre"));
            $al->setPrimerapellidoalumno($request->get("primer_apellido"));
            $al->setSegundonombrealumno($request->get("segundo_nombre"));
            $al->setSegundoapellidoalumno($request->get("segundo_apellido"));
            $al->setFechanacimiento(new \DateTime($request->get("fecha_nacimiento")));
            $al->setDireccioncasa("xx");
            $al->setTelefonocasa("xx");
            $al->setPadrepadre($this->getDoctrine()->getRepository('AppBundle:Padre')->find($request->get('padre')));
            $al->setResponsableresponsable($em->getRepository('AppBundle:Responsable')->find($request->get("responsable")));

            // Transformar la Edad
            $fecha=$al->getFechanacimiento()->format('Y-m-d H:i:s');
            $segundos=strtotime('now') - strtotime($fecha);
            //Para hacerlo dias
            $edad=intval($segundos/60/60/24/365);
            // ******************
            $al->setEdad($edad);

            $em->persist($al);
            $em->flush();
            return $this->redirectToRoute('antiguo');
        }
        $respon = $em->getRepository("AppBundle:Responsable")->findAll();
        $padre = $em->getRepository("AppBundle:Padre")->findAll();
        return $this->render('AppBundle:formularios:alumno-inline.html.twig', array('responsables' => $respon,'padres' => $padre));

    }
    /**
     * @Route("/padreInsertar",name="padreinsert")
     */
    public function padreInsertAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $p=new Padre();
            $p->setNombrepadre($request->get("nombreP"));
            $p->setTelefonotrabajopadre($request->get("telP"));
            $p->setLugartrabajop($request->get("tP"));
            $p->setNombremadre($request->get("nombreM"));
            $p->setTelefonotrabajomadre($request->get("telM"));
            $p->setLugartrabajom($request->get("tM"));

            $em->persist($p);
            $em->flush();
            return $this->redirectToRoute('antiguo');
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
            return $this->redirectToRoute('antiguo');
        }
        return $this->render('AppBundle:formularios:responsable-inline.html.twig');
    }
    /**
     * @Route("/matriculanuevo",name="matnuevo")
     */
    public function matriculaNuevoAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        $al=$em->getRepository('AppBundle:Alumno')->findAll();
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
            $mat->setEsactivo(1);
            $mat->setNivelnivel($em->getRepository('AppBundle:Nivel')->find(1));
            $mat->setAlumnoCarnetalumno($em->getRepository('AppBundle:Alumno')->find($request->get('carnet')));
            //Perisistencia
            $em->persist($mat);
            $em->flush();
            return $this->redirectToRoute('antiguo');
        }
        return $this->render('AppBundle:formularios:matricula-nvo.html.twig',array('alumnos' =>$al));
    }
    /**
     * @Route("/matriculaantiguo",name="matantiguo")
     */
    public function matriculaAntiguaAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        $nivel=$em->getRepository('AppBundle:Nivel')->findAll();
        $al=$em->getRepository('AppBundle:Alumno')->findAll();
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
            return $this->redirectToRoute('matantiguo');
        }
        return $this->render('AppBundle:formularios:matricula.html.twig',array('niveles'=>$nivel,'alumnos' =>$al));
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
     * @Route("/ferloco")
     */
    public function locoAction(){
        return $this->render('AppBundle::echo.html.twig');
    }
    /**
     * @Route("/completar")
     */
    public function completarAction(){
        return $this->render('AppBundle::echo1.html.twig');
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
}
