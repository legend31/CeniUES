<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 14/10/2015
 * Time: 2:46 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportesController extends Controller
{
    /**
     * @Route("/Reportes", name="rhome")
     */
    public function modulosnivelesAction()
    {
        return $this->render('AppBundle:reportes:principalreporte.html.twig');

    }

    /**
     * @Route("/Ainscritos", name="ainscritos")
     */
    public function alumnosInscritosAction()
    {
        /*$em = $this->getDoctrine()->getEntityManager();
        $alumnos = $em->getRepository('AppBundle:Alumno')->findAll();

        if(!$alumnos)
        {
            throw $this->createNotFoundException('No se encontro ningun docente');
        }
        return new Response($this->container->get('templating')->render('AppBundle:reportes:alumnosinscritos.html.twig', array('TituloPagina' => 'Alumnos inscritos', 'form' => $alumnos)));
        */
        $mat=$this->getDoctrine()->getRepository('AppBundle:Matricula')->alumnosmMatriculados();
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');
        return $this->render('AppBundle:reportes:listadoAlumnosFer.html.twig',array('mat'=>$mat));
    }
    /**
     * @Route("/listadoAlumnosPdf",name="listadoAlumPdf")
     */
    public function pdfAlumnosAction(){
        $mat=$this->getDoctrine()->getRepository('AppBundle:Matricula')->alumnosmMatriculados();
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoporniveles.pdf');
        return $pdfGenerator->displayForView('AppBundle:reportes:listadoAlumnosPdf.html.twig',array('mat'=>$mat));
    }
    /**
     * @Route("/listadoDocentesPdf",name="listadoDocentesPdf")
     */
    public function pdfDocentesAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();
        $pdfGenerator=$this->get('siphoc.pdf.generator');
        $pdfGenerator->setName('listadoDocentes.pdf');
        return $pdfGenerator->displayForView('AppBundle:reportes:listadoDocentesPdf.html.twig',array('form'=>$docentes));
    }

    /**
     * @Route("/LisNxM", name="lnivelesmodulos")
     */
    public function listNivxModAction()
    {
        //$modulo= $this->getDoctrine()->getRepository('AppBundle:Modulo')->find($id);
        //$niveles = $modulo->getNivelnivel();
        $em = $this->getDoctrine()->getRepository('AppBundle:Nivel');
        $niveles = $em->findAll();

        if(!$niveles){
            throw $this->createNotFoundException('No se encontraron niveles');

        }
        return new Response($this->container->get('templating')->render('AppBundle:reportes:listNivelesxMod.html.twig',array('niv' => $niveles)));
    }
}