<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 20/9/2015
 * Time: 8:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Docente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DocenteController extends Controller
{
    /**
     * @Route("/docentes", name="dhome")
     */
    public function docenteHomeAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();

        if(!$docentes)
        {
            throw $this->createNotFoundException('No se encontro ningun docente');
        }

        return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes)));
        //return $this->render('AppBundle:docente:gestionarDocente.html.twig');//return $this->render('AppBundle:docente:pdoc.html.twig');
    }

    /**
     * @Route("/adocente", name="agregarD")
     */
    public function agregarDocenteAction()
    {
        $docente= new Docente();

        $form = $this->createFormBuilder($docente)
            ->add('carnetdocente','text',array('label' => 'Carnet del docente'))
            ->add('nombredocente','text',array('label' => 'Nombre'))
            ->add('apellidodocente','text',array('label' => 'Apellido'))
            ->add('dui','text',array('label' => 'DUI'))
            ->add('direcciondocente','text',array('label' => 'Direccion de residencia'))
            ->add('telefono','text',array('label' => 'N&uacute;mero telef&oacute;nico'))
            ->add('fechanacimiento','datetime',array('label' => 'Fecha de nacimiento'))
            ->add('save', 'submit', array('label' => 'Agregar Docente'))
            ->getForm();

        $html = $this->container->get('templating')->render('AppBundle:docente:creardocente.html.twig', array('TituloPagina' => 'Agregar Docente', 'form' => $form->createView()));

        return new Response($html);
    }

    /**
     * @Route("/cdocente", name="consultarD")
     */
    public function consultarDocenteAction()
    {

        $html = $this->container->get('templating')->render('AppBundle:docente:cruddocente.html.twig', array('TituloPagina' => 'Consultar Docente','form' => $form->createView()));

        return new Response($html);
    }

    /**
     * @Route("/dnivel", name="docn")
     */
    public function docenteNivelAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll('primernombredocente');
        $locales = $em->getRepository('AppBundle:Local')->findAll();
        $niveles = $em->getRepository('AppBundle:Nivel')->findAll();
        $seccion = $em->getRepository('AppBundle:Seccion')->findAll();

        if(!$docentes||!$locales||!$niveles)
        {
            throw $this->createNotFoundException('No se encontro ningun dato relacionado');
        }

        return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes)));
    }
}