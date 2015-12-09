<?php
namespace AppBundle\Clases;
use AppBundle\Entity\Detalleevaluacion;
use AppBundle\Entity\Resultadoevaluacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DSIController extends Controller
{
    //Envia Mensajes Flash
    protected function MensajeFlash($nombre,$mensaje){
        $this->get('session')->getFlashBag()->add(
            ''.$nombre,
            ''.$mensaje
        );
    }
    //Funciones de Ingreso por Examen de colocacion
    protected function ingresarNotas($em,$carnet,$eva,$nota,$detalle){
        $alumno=$em->getRepository('AppBundle:Alumno')->findOneBy(array('carnetalumno'=>$carnet));
        //Creacion del resultado
        $resultado=new Resultadoevaluacion();
        $resultado->setAlumnoCarnetalumno($alumno);
        $resultado->setDetalleevaluaciondetalleevaluacion($detalle);
        $resultado->setEvaluacionevaluacion($eva);
        //la nota del formulario
        $resultado->setNota($nota);
        //Peristencia
        $em->persist($detalle);
        $em->persist($resultado);
        $em->flush();
    }
    protected function crearDetalle($em,$n,$modulo){
        //Docente
        $docente=$em->getRepository('AppBundle:Docente')->find("DC00002");
        //Verificando el modulo

        $nivel=$em->getRepository('AppBundle:Nivel')->find($n);
        //creacion del detalle de evaluacion
        $resul=$em->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('docenteCarnetdocente'=>$docente,'modulomodulo'=>$modulo,'nivelnivel'=>$nivel));
        if($resul)
            return $resul;
        else{
            $detalle=new Detalleevaluacion();
            $detalle->setDocenteCarnetdocente($docente);
            $detalle->setModulomodulo($modulo);
            $detalle->setNivelnivel($nivel);
            //persistencia
            $em->persist($detalle);
            $em->flush();
            $resul=$em->getRepository('AppBundle:Detalleevaluacion')->findOneBy(array('docenteCarnetdocente'=>$docente,'modulomodulo'=>$modulo,'nivelnivel'=>$nivel));
            return $resul;
        }
    }
    protected  function crearRecord($em,$eva,$request,$modulo){
        $n=$request->get('nivel');
        for($i=1;$i<$n;$i++){
            $detalle=$this->crearDetalle($em,$i,$modulo);
            foreach($eva as $evaluaciones){
                $this->ingresarNotas($em,$request->get('carnet'),$evaluaciones,$request->get('nota'),$detalle);
            }
        }
    }
    //Obtiene los niveles del modulo activo
    protected function obtenerNivelesActivos(){
        $fechahoy=new \DateTime('now');
        //Para jalar el modulo activo
        $modulo=$this->getDoctrine()->getRepository('AppBundle:Modulo')->verificarModulo($fechahoy);
        return $modulo;

    }
}