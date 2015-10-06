<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ModulosNivelesController extends Controller{

    /**
     * @Route("/modulosyniveles", name="gmyn")
     */
    public function modulosnivelesAction(){
        return $this->render('AppBundle:admin:gmodulosniveles/mynPrincipal.html.twig');

    }

    /**
     * @Route("/modulos", name="gmodulos")
     */
    public function gmodulosAction(){

        $repositorio = $this->getDoctrine()->getRepository('AppBundle:Modulo');
        $modulo = $repositorio->findAll();

        return $this->render('AppBundle:admin:gmodulosniveles/gmodulos.html.twig',array('modulo' => $modulo));
    }

    /**
     * @Route("/infomodulo", name="infomod")
     */
    public function obtenerPorIdAction(){
        $request = $this->get('request');
        $idpasado = $request->get('idmodulo');
        $repo = $this->getDoctrine()->getRepository('AppBundle:Modulo');
        $mod = $repo->findOneBy(array('idmodulo'=>$idpasado));

        return new JsonResponse(array("idmod"=>$mod->getIdmodulo(),
            "nombremod"=>$mod->getNombremodulo(),
            "fechainicio"=>$mod->getFechainicio(),
            "fechafin"=>$mod->getFechafin(),
            "duracion"=>$mod->getDuracion()));

    }

/*Seccion dedicada para la gestion de niveles*/
    /**
     * @Route("/niveles", name="gniveles")
     */
    public function gnivelesAction(){
        return $this->render('AppBundle:admin/gmodulosniveles:gniveles.html.twig');
    }


}