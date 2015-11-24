<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Seccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeccionController extends Controller
{
    /**
     * @Route("/seccionNuevo",name="nvoseccion")
     */
    public function seccionNvoAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //Envio del Form?
        if($request->isMethod("POST"))
        {
            //Creo una nueva Seccion
            $s=new Seccion();
            $s->setNombreseccion($request->get("nombre"));

            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('secHome');
        }
        return $this->render('AppBundle:formularios:seccion-inline.html.twig');
    }

    /**
     * @Route("/seccionHome",name="secHome")
     */
    public function seccionListarAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $secciones=$em->getRepository('AppBundle:Seccion')->findAll();
        //return $this->render('AppBundle:seccion:seccion-listar.html.twig',array('secciones'=>$secciones));
        return $this->render('AppBundle:formularios:seccionquemada.html.twig',array('secciones'=>$secciones));
    }
    /**
     * @Route("/seccionUpdate/{id}",name="secAct")
     */
    public function seccionActualizarAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $seccion=$em->getRepository('AppBundle:Seccion')->find($id);

        if($request->isMethod("POST")){
            $seccion->setNombreseccion($request->get("nombre"));
            $em->flush();
            return $this->redirectToRoute('secHome');
        }
        return $this->render('AppBundle:seccion:seccion-mod.html.twig',array('seccion'=>$seccion,'id'=>$id));
    }
    /**
     * @Route("/seccionDelete/{id}",name="secDel")
     */
    public function seccionEliminarAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $seccion=$em->getRepository('AppBundle:Seccion')->find($id);

        $em->remove($seccion);
        $em->flush();
        return $this->redirectToRoute('secHome');
    }
}
