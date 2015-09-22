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
        return $this->render('AppBundle:docente:pdoc.html.twig');
    }

    /**
     * @Route("/adocente", name="agregarD")
     */
    public function agregarDocenteAction()
    {
        $docente= new Docente();

        $form = $this->createFormBuilder($docente)
            ->add('carnetdocente','text',array('label' => 'Carnet del docente'))
            ->add('primernombredocente','text',array('label' => 'Primer nombre'))
            ->add('segundonombredocente','text',array('label' => 'Segundo nombre'))
            ->add('primerapellidodocente','text',array('label' => 'Primer apellido'))
            ->add('segundoapellidodocente','text',array('label' => 'Segundo apellido'))
            ->add('dui','text',array('label' => 'DUI'))
            ->add('direcciondocente','text',array('label' => 'Dirección de residencia'))
            ->add('telefono','text',array('label' => 'Número telefónico'))
            ->add('fechanacimiento','datetime',array('label' => 'Fecha de nacimiento'))
            ->add('save', 'submit', array('label' => 'Agregar Docente'))
            ->getForm();

        $html = $this->container->get('templating')->render('AppBundle:docente:cruddocente.html.twig', array('TituloPagina' => 'Agregar Docente', 'form' => $form->createView()));

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
            ->add('carnetdocente','text', array('label' => 'Ingrese carnet'))
            ->add('save', 'submit', array('label' => 'Buscar Docente'))
            ->getForm();
        $html = $this->container->get('templating')->render('AppBundle:docente:cruddocente.html.twig', array('TituloPagina' => 'Eliminar Docente','form' => $form->createView()));

        return new Response($html);
    }
}