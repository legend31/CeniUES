<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel;
use AppBundle\Entity\Seccion;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends Controller
{
    /**
     * @Route("/aprobadosGrafico",name="graficoAprobados")
     */
    public function aprobadosAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Porcentaje de Aprobados/Reporobados');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'),
            'showInLegend'  => true
        ));
        //Logica
        $em=$this->getDoctrine()->getManager();
        $matricula=$em->getRepository('AppBundle:Matricula')->findBy(array('esactivo'=>1));
        $total=0;
        $aprob=0;
        foreach($matricula as $mat)
        {
            $record_A=$em->getRepository('AppBundle:Recordalumno')->findOneBy(array('alumnoCarnetalumno'=>$mat->getAlumnoCarnetalumno()));
            if($record_A)
            {
                if($record_A->getNotafinal()>=7)
                    $aprob++;
            }
            $total++;
        }
        $prom=round($aprob/$total,2);
        $np=1-$prom;
        //Data a Enviar
        $data = array(
            array('Alumnos Aprobados '.$aprob, $prom),
            array('Alumnos Reprobados '.($total-$aprob), $np),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Porcentaje', 'data' => $data)));
        return $this->render('AppBundle:record:aprobadosGrafico.html.twig', array(
            'chart' => $ob
        ));
    }
    /**
     * @Route("/activosGrafico",name="graficoActivos")
     */
    public function activosAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Porcentaje de Alumnos Activos/Inanctivos en CENIUES');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'),
            'showInLegend'  => true
        ));
        //Logica
        $nMat=$this->getDoctrine()->getRepository('AppBundle:Matricula')->numeroMatriculados();
        $nAct=$this->getDoctrine()->getRepository('AppBundle:Matricula')->numeroActivos();
        $promedio=round($nAct/$nMat,2);
        $np=1-$promedio;
        //Data a Enviar
        $data = array(
            array('Alumnos Activos '.$nAct, $promedio),
            array('Alumnos Inactivos '.($nMat-$nAct), $np),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Porcentaje', 'data' => $data)));
        return $this->render('AppBundle:record:aprobadosGrafico.html.twig', array(
            'chart' => $ob
        ));
        /*$series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        return $this->render('AppBundle:record:aprobadosGrafico.html.twig', array(
            'chart' => $ob
        ));*/
    }
    /**
     * @route("/lineaGrafica",name="graficoAlumno")
     */
    public function linealAction(){
        //$mat=$this->getDoctrine()->getRepository('AppBundle:Matricula')->alumnosmMatriculados();
        //$record=$this->getDoctrine()->getRepository('AppBundle:Recordalumno')->numeroNotas(5);
        //var_dump($record);
        for($i=1;$i<11;$i++){
            $notas[]=$this->getDoctrine()->getRepository('AppBundle:Recordalumno')->numeroNotas($i);
        }
        //echo json_encode($pp);
        //return $this->render('AppBundle::linea.html.twig');
        return $this->render('AppBundle:record:linea.html.twig',array('datos'=>json_encode($notas,JSON_NUMERIC_CHECK)));
    }
}

