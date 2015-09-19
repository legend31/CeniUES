<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MatriculaController extends Controller
{
    /**
     * @Route("/desmatricular/{d}",defaults={"d" = 0},name="des")
     */
    public function desmatricularAction(Request $request,$d)
    {
        $form=$this->createFormBuilder()
            ->add('Carnet','search')
            ->add('Buscar','submit')
            ->getForm();
        $form->handleRequest($request);
        if($d>0){
            $em=$this->getDoctrine()->getManager();
            $mat=$em->getRepository('AppBundle:Matricula')->find($d);
            $mat->setEsactivo(0);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'mensaje',
                'Desmatriculacion Exitosa'
            );
            return $this->redirectToRoute('des');
        }
        if($form->isValid()) {
            $form->getData();
            $data = $form->getData();
            $al = $this->getDoctrine()->getRepository('AppBundle:Alumno')->find($data['Carnet']);
            return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al, 'formulario' => $form->createView()));
        }
        else
            return $this->render('AppBundle:matricula:desmatricular.html.twig',array('al'=>'', 'formulario' => $form->createView()));
    }
    private function desmatricular($d){
        if($d>0){
            $em=$this->getDoctrine()->getManager();
            $mat=$em->getRepository('AppBundle:Matricula')->find($d);
            $mat->setEsactivo(0);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'mensaje',
                'Desmatriculacion Exitosa'
            );
            return $this->redirectToRoute('des');
        }
    }
}
