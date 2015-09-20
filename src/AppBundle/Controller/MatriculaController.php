<?php

namespace AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Alumno;
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
            $m=   $this->getDoctrine()->getRepository('AppBundle:Matricula')->findOneByalumnoCarnetalumno($data['Carnet']);
            return $this->render('AppBundle:matricula:desmatricular.html.twig', array('al' => $al,'mat' =>$m, 'formulario' => $form->createView()));
        }
        else
            return $this->render('AppBundle:matricula:desmatricular.html.twig',array('al'=>'', 'formulario' => $form->createView()));
    }

    /**
     * @Route("/antiguo",name="antiguo")
     */
    public function antiguoMenuAction(){
        return $this->render('AppBundle:matricula:antiguoingreso.html.twig');
    }

    /**
     * @Route("/alumnoinsertar",name="alumnoinsert")
     */
    public function alumnoInsertAction(Request $request){

        $em = $this->getDoctrine()->getEntityManager();
        if($request->isMethod("POST")) {
            $al = new Alumno();
            $al->setCarnetalumno($request->get("carnet"));
            $al->setPrimernombrealumno($request->get("primer_nombre"));
            $al->setPrimerapellidoalumno($request->get("primer_apellido"));
            $al->setSegundonombrealumno($request->get("segundo_nombre"));
            $al->setSegundoapellidoalumno($request->get("segundo_apellido"));
            $al->setFechanacimiento(new \DateTime($request->get("fecha_nacimiento")));
            $al->setEdad($request->get("edad"));
            $al->setDireccioncasa("xx");
            $al->setTelefonocasa("xx");
            $al->setMatriculamatricula($this->getDoctrine()->getRepository('AppBundle:Matricula')->find($request->get('matricula')));
            $al->setPadrepadre($this->getDoctrine()->getRepository('AppBundle:Padre')->find($request->get('padre')));
            $al->setResponsableresponsable($em->getRepository('AppBundle:Responsable')->find($request->get("responsable")));

            $em->persist($al);
            $em->flush();
            return $this->redirectToRoute('antiguo');
        }
        $respon = $em->getRepository("AppBundle:Responsable")->findAll();
        $mat = $em->getRepository("AppBundle:Matricula")->findAll();
        $padre = $em->getRepository("AppBundle:Padre")->findAll();
        return $this->render('AppBundle:formularios:alumno-inline.html.twig', array('responsables' => $respon, 'matriculas' => $mat, 'padres' => $padre));
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
