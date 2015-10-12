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
        $docente= new Docente();

        $form = $this->createFormBuilder($docente)
            ->add('carnetdocente','text', array('label' => 'Ingrese carnet'))
            ->add('save', 'submit', array('label' => 'Buscar Docente'))
            ->getForm();
        $html = $this->container->get('templating')->render('AppBundle:docente:cruddocente.html.twig', array('TituloPagina' => 'Consultar Docente','form' => $form->createView()));

        return new Response($html);
    }

    /**
     * @Route("/edocente", name="eliminarD")
     */
    public function eliminarDocenteAction()
    {
        $docente= new Docente();

        $form = $this->createFormBuilder($docente)
            ->add('carnetdocente','text', array('label' => 'Ingrese carnet', 'attr' => array('maxlength' => 7)))
            ->add('save', 'submit', array('label' => 'Eliminar Docente'))
            ->getForm();
        $html = $this->container->get('templating')->render('AppBundle:docente:cruddocente.html.twig', array('TituloPagina' => 'Eliminar Docente','form' => $form->createView()));

        return new Response($html);
    }
}