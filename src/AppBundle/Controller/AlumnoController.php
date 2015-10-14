<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AlumnoController extends Controller
{
    /**
     * @Route("/antiguo",name="antiguo")
     */
    public function MenuAction(){
        return $this->render('AppBundle:alumno:alumnotabs.html.twig');
    }
    /**
     * @Route("/alumnoBuscar",name="alBuscar")
     */
    public function alumnoBuscarAction(Request $request){
        $em=$this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")){
            $alumno=$em->getRepository('AppBundle:Alumno')->find($request->get("carnet"));
            return $this->render('AppBundle:alumno:alumno-buscar.html.twig',array('al'=>$alumno));

        }
        return $this->render('AppBundle:alumno:alumno-buscar.html.twig',array('al'=>''));
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
            $this->MensajeFlash('Modificacion exitosa');
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
            $this->MensajeFlash('Modificacion exitosa');
            return $this->redirectToRoute('alBuscar');
        }
        return $this->render('AppBundle:alumno:responsable-mod.html.twig',array('responsable'=>$res,'id'=>$id));
    }
    /**
     * @Route("/alumUpdate/{id}",name="alumUp")
     */
    public function AlumUpAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $res=$em->getRepository('AppBundle:Alumno')->find($id);
        if($request->isMethod("POST")){
            $res->setNombreresponsable($request->get("nombre"));
            $res->setParentesco($request->get("parentesco"));
            $res->setTelefono($request->get("tel"));

            $em->persist($res);
            $em->flush();
            //Mensaje Flash
            $this->MensajeFlash('Modificacion exitosa');
            return $this->redirectToRoute('alBuscar');
        }
        return $this->render('AppBundle:alumno:responsable-mod.html.twig',array('responsable'=>$res,'id'=>$id));
    }
    private function MensajeFlash($m){
        $this->get('session')->getFlashBag()->add(
            'mensaje',
            ''.$m
        );
    }
}
