<?php

namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
use AppBundle\Entity\Modulo;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Seccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeccionController extends DSIController
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
            if($em->getRepository('AppBundle:Seccion')->findOneBy(array('nombreseccion'=>$request->get("nombre")))){
                $this->MensajeFlash('error','Seccion ya existe!!');
                return $this->redirectToRoute('secHome');
            }
            else {
                //Creo una nueva Seccion
                $s = new Seccion();
                $s->setNombreseccion($request->get("nombre"));
                $em->persist($s);
                $em->flush();
                return $this->redirectToRoute('secHome');
            }
        }
        return $this->render('AppBundle:formularios:seccion-inline.html.twig');
    }
    /**
     * @Route("/secInNAdd/{id}",name="nvoseccionAddN")
     */
    public function seccionNAddAction($id)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //Relacionando los objetos
        $nivel=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find($id);
        $nivel->addSeccionseccion($em->getRepository('AppBundle:Seccion')->find(1));
        $em->flush($nivel);
        return $this->redirectToRoute('secHome');
    }

    /**
     * @Route("/seccionHome",name="secHome")
     */
    public function seccionListarAction(Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //$secciones=$em->getRepository('AppBundle:Nivel')->findAll();
        $secciones=$em->getRepository('AppBundle:Modulo')->findAll();
        //return $this->render('AppBundle:seccion:seccion-listar.html.twig',array('secciones'=>$secciones));
        return $this->render('AppBundle:formularios:seccionquemada.html.twig',array('modulos'=>$secciones));
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
    /**
     * @Route("/secAddNivel/{id}",name="nvoseccionAddN")
     */
    public function seccionAddNivel($id)
    {
        $em=$this->getDoctrine()->getEntityManager();
        //Relacionando los objetos
        $secciones=$em->getRepository('AppBundle:Seccion')->findAll();
        $nivel=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find($id);
        $i=0;
        foreach($nivel->getSeccionseccion() as $n){
            foreach($secciones as $s){
                if($n->getIdseccion()==$s->getIdseccion())
                    unset($secciones[$i]);

            }
            $i++;
        }
        var_dump($secciones);
        /*$nivel->addSeccionseccion($em->getRepository('AppBundle:Seccion')->find(1));
        $em->flush($nivel);
        return $this->redirectToRoute('secHome');*/
        return new Response();
    }
}
