<?php

namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
use AppBundle\Entity\Alumno;
use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Padre;
use AppBundle\Entity\Responsable;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AlumnoController extends DSIController
{
    /**
     * @Route("/nuevoAlumMenu",name="antiguo")
     */
    public function MenuAction(){
        return $this->render('AppBundle:alumno:alumnotabs.html.twig');
    }
    /**
     * @Route("/alumnoinsertar",name="alumnoinsert")
     */
    public function alumnoInsertAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        //Validando el envio del formulario
        if($request->isMethod("POST")) {
            $duplicado=$em->getRepository('AppBundle:Alumno')->find($request->get("carnet"));
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
                //Cifra la contrase�a
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
        return $this->redirectToRoute('antiguo');

    }

    /**
     * @Route("/padreInsertar",name="padreinsert")
     */
    public function padreInsertAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $padre=$em->getRepository('AppBundle:Padre')->findOneBy(array('nombrepadre'=>$request->get("nombreP")));
            //Validacion del padre
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
                $this->MensajeFlash('exito','Padre Ingresado exitosamente!');
                return $this->redirectToRoute('antiguo');
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
            $res=$em->getRepository('AppBundle:Responsable')->findOneBy(array('nombreresponsable'=>$request->get("nombre")));
            if($res){
                $this->MensajeFlash('fracaso','Responsable ya Registrado en el sistema!');
                return $this->redirectToRoute('antiguo');
            }
            else{
                $res=new Responsable();
                $res->setNombreresponsable($request->get("nombre"));
                $res->setParentesco($request->get("parentesco"));
                $res->setTelefono($request->get("tel"));

                $em->persist($res);
                $em->flush();
                $this->MensajeFlash('exito','Responsable Insertado exitosamente!');
                return $this->redirectToRoute('antiguo');
            }
        }
        return $this->render('AppBundle:formularios:responsable-inline.html.twig');
    }

    /**
     * @Route("/alumnoBuscar",name="alBuscar")
     */
    public function alumnoBuscarAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        $alumno=$em->getRepository('AppBundle:Alumno')->findAll();
        if($request->isMethod("POST")){
            $al=$em->getRepository('AppBundle:Alumno')->find($request->get("carnet"));
            $mat=$em->getRepository('AppBundle:Matricula')->findOneBy(array('alumnoCarnetalumno'=>$al));
            return $this->render('AppBundle:alumno:alumno-buscar.html.twig',array('al'=>'','alu'=>$al,'mat'=>$mat));
        }
        return $this->render('AppBundle:alumno:alumno-buscar.html.twig',array('al'=>$alumno,'alu'=>'','mat'=>$alumno));
    }
    /**
     * @Route("/padreUpdate/{id}",name="padreUp")
     */
    public function padreUpAction(Request $request,$id){
        $em=$this->getDoctrine()->getEntityManager();
        $p=$em->getRepository('AppBundle:Padre')->find($id);
        if($request->isMethod("POST")){
            $p->setNombrepadre($request->get("nombreP"));
            $p->setTelefonotrabajopadre($request->get("telP"));
            $p->setLugartrabajop($request->get("tP"));
            $p->setNombremadre($request->get("nombreM"));
            $p->setTelefonotrabajomadre($request->get("telM"));
            $p->setLugartrabajom($request->get("tM"));

            $em->flush($p);
            //Mensaje Flash
            $this->MensajeFlash('exito','Modificacion exitosa');
            return $this->redirectToRoute('alBuscar');
        }
        return $this->render('AppBundle:alumno:padre-mod.html.twig',array('padre'=>$p,'id'=>$id));

    }
    /**
     * @Route("/responUpdate/{id}",name="responUp")
     */
    public function responUpAction(Request $request,$id){
        $em=$this->getDoctrine()->getEntityManager();
        $res=$em->getRepository('AppBundle:Responsable')->find($id);
        if($request->isMethod("POST")){
            $res->setNombreresponsable($request->get("nombre"));
            $res->setParentesco($request->get("parentesco"));
            $res->setTelefono($request->get("tel"));

            $em->persist($res);
            $em->flush();
            //Mensaje Flash
            $this->MensajeFlash('exito','Modificacion exitosa');
            return $this->redirectToRoute('alBuscar');
        }
        return $this->render('AppBundle:alumno:responsable-mod.html.twig',array('responsable'=>$res,'id'=>$id));
    }
    /**
     * @Route("/alumUpdate/{id}",name="alumUp")
     */
    public function AlumUpAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $al=$em->getRepository('AppBundle:Alumno')->find($id);
        if($request->isMethod("POST")){
            $al->setPrimernombrealumno($request->get("primer_nombre"));
            $al->setPrimerapellidoalumno($request->get("primer_apellido"));
            $al->setSegundonombrealumno($request->get("segundo_nombre"));
            $al->setSegundoapellidoalumno($request->get("segundo_apellido"));

            $em->flush();
            //Mensaje Flash
            $this->MensajeFlash('exito','Modificacion exitosa');
            return $this->redirectToRoute('alBuscar');
        }
        return $this->render('AppBundle:alumno:alumno-mod.html.twig',array('alumno'=>$al,'id'=>$id));
    }
    /**
     * @Route("/alumDel/{id}",name="alumDel")
     */
    public function AlumDelete($id){
        $em=$this->getDoctrine()->getManager();
        $al=$em->getRepository('AppBundle:Alumno')->find($id);
        $em->remove($al);
        $em->flush();
        $this->MensajeFlash('exito','Alumno Eliminado Exitosamente');
        return $this->redirectToRoute('alBuscar');

    }
}
