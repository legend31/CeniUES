<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel;
use Proxies\__CG__\AppBundle\Entity\Modulo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

class ModulosNivelesController extends Controller{
    //funcion encargada de redirigir al sub menu de las gestion de modulos y niveles
    /**
     * @Route("/admin/modulosyniveles", name="gmyn")
     */
    public function modulosnivelesAction(){
        return $this->render('AppBundle:admin:gmodulosniveles/mynPrincipal.html.twig');

    }

    /**
     * @Route("/admin/modulos", name="gmodulos")
     */
    public function gmodulosAction(){

        $repositorio = $this->getDoctrine()->getRepository('AppBundle:Modulo');
        $modulo = $repositorio->findAll();
        if($modulo) {
            return $this->render('AppBundle:admin:gmodulosniveles/gmodulos.html.twig', array('modulo' => $modulo));
        }else{
            throw $this->createNotFoundException("No se encontraron ningun modulo registrado");
        }
    }

    /**
     * @Route("/admin/infomodulo", name="infomod")
     */
    public function obtenerPorIdAction(){
        $request = $this->get('request');
        $idpasado = $request->get('idmodulo');
        $repo = $this->getDoctrine()->getRepository('AppBundle:Modulo');
        $mod = $repo->findOneBy(array('idmodulo'=>$idpasado));

        return new JsonResponse(array("idmod"=>$mod->getIdmodulo(),
            "nombremod"=>$mod->getNombremodulo(),
            "fechainicio"=>$mod->getFechainicio()->format('Y-m-d'),
            "fechafin"=>$mod->getFechafin()->format('Y-m-d'),
            "duracion"=>$mod->getDuracion()));

    }

    //FUNCION ENCARGADA DE GENERAR LA VISTA PARA INGRESAR UN NUEVO NIVEL
    /**
     * @Route("/admin/newmodulo", name="newmodulo")
     */
    public function nuevoModuloAction(){
        return $this->render('@App/admin/gmodulosniveles/formNuevoModulo.html.twig');
    }

    //FUNCION ENCARGADA DE REALIZAR EL INGRESO DE EL MODULO
    /**
     * @Route("/admin/nmod", name="nmod")
     */
    public function newModuloAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $repmod = $this->getDoctrine()->getRepository('AppBundle:Modulo');
        //Verifico el envio de form
        if($request->isMethod("POST")){
            //$auxmod= new Modulo();
            //$auxmod = $repmod->findOneBy(".'$request->get('nombreMod')'.");

            $mod = new Modulo();
            $mod->setNombremodulo($request->get('nombreMod'));
            $em->persist($mod);
            $em->flush();
            return $this->redirectToRoute('newmodulo');

        }
        return $this->render('AppBundle:admin/gmodulosniveles:formNuevoModulo.html.twig');

    }
    


    /*-----------------------------------------------------------------------------------------------------------------*/
/*Seccion dedicada para la gestion de niveles*/
    /**
     * @Route("/admin/niveles", name="gniveles")
     */
    public function gnivelesAction(){
        $em = $this->getDoctrine()->getManager();
        $auxnivel = new Nivel();
        $repo = $em->getRepository('AppBundle:Nivel');
        $auxnivel= $repo->findAll();
        return $this->render('AppBundle:admin/gmodulosniveles:gniveles.html.twig',array('listNivel'=>$auxnivel));
    }

    //FUNCION QUE DA LA VISTA PARA INGRESAR UN NUEVO NIVEL
    /**
     * @Route("/admin/newnivel", name="newnivel")
     */
    public function newNivelAction(){
        return $this->render('AppBundle:admin/gmodulosniveles:formNuevoNivel.html.twig');
    }

    //FUNCION ENCARGADA DE INGRESAR EL NIVEL ESCRITO EN PANTALLA
    /**
     * @Route("/admin/nnivel", name="nnivel")
     */
    public function agregarNivelAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        if($request->isMethod("POST")){
            $niv= new Nivel();
            $niv->setNombrenivel($request->get("nombreNivel"));
            $em->persist($niv);
            $em->flush();

            return $this->redirectToRoute('newnivel');
        }

        return $this->render('AppBundle:admin/gmodulosniveles:formNuevoNivel.html.twig');
    }


}