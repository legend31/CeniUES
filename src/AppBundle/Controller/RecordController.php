<?php

namespace AppBundle\Controller;

use AppBundle\Clases\DSIController;
use AppBundle\Entity\Nivel;
use AppBundle\Entity\Seccion;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends DSIController
{
    /**
     * @Route("/aprobadosGrafico",name="graficoAprobados")
     */
    public function aprobadosAction()
    {
        //Creando y configurando el grafico
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Porcentaje de Aprobados/Reporobados');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'),
            'showInLegend'  => true
        ));
        //Logica de los datos
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
 * @route("/lineaGrafica/{nivel}/{mod}",name="graficoAlumno")
 */
    public function linealAction($nivel,$mod){
        //El id es el Nivel
        $em=$this->getDoctrine()->getManager();
        //$niveles=$em->getRepository('AppBundle:Nivel')->findAll();
        //$niveles=$this->obtenerNivelesActivos();
        $niveles=$em->getRepository('AppBundle:Modulo')->find($mod);
        $records=$em->getRepository('AppBundle:Record')->findAll();
        $modulos=$em->getRepository('AppBundle:Modulo')->findAll();
        for($i=1;$i<11;$i++) {
            $c=0;
            if($nivel==0)
                $notas[]=$this->getDoctrine()->getRepository('AppBundle:Recordalumno')->numeroNotas($i);
            else
            {
                foreach ($records as $re){
                    //Para todos los niveles
                    $notaAlumno=$re->getRecordalumnorecordalumno()->getNotafinal();
                    if($re->getNivelnivel()->getIdnivel()==$nivel&&$notaAlumno>=$i&&$notaAlumno<($i+1))
                        if($em->getRepository('AppBundle:Matricula')->findOneBy(array('nivelnivel'=>$re->getNivelnivel(),'esactivo'=>1,'alumnoCarnetalumno'=>$re->getRecordalumnorecordalumno()->getAlumnoCarnetalumno())))
                            $c++;
                }
                $notas[]=$c;
            }
        }
        return $this->render('AppBundle:record:linea.html.twig',array('modulos'=>$modulos,'selectedModulo'=>$mod,'datos'=>json_encode($notas,JSON_NUMERIC_CHECK),'niveles'=>$niveles,'selectedNivel'=>$nivel));
    }
    /**
     * @Route("/graficos",name="graf")
     */
    public function graficosAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        //$niveles=$em->getRepository('AppBundle:Nivel')->findAll();
        //Modulo
        $niveles=$this->obtenerNivelesActivos();
        $ob=$this->graficoAprobados(0);
        if($request->isMethod("POST")){
            if($request->get('grafico')=='aprob') {
                $ob=$this->graficoAprobados($request->get('nivel'));
                return $this->render('AppBundle::reportes-select.html.twig', array('niveles' => $niveles, 'chart' => $ob,'selected'=>'aprob','selectedNivel'=>$request->get('nivel')));
            }
            if($request->get('grafico')=='act'){
                $ob=$this->graficaActivos();
                return $this->render('AppBundle::reportes-select.html.twig',array('niveles'=>$niveles,'chart' => $ob,'selected'=>'act','selectedNivel'=>$request->get('nivel')));
            }
            if($request->get('grafico')=='not'){
                return $this->redirectToRoute('graficoAlumno',array('nivel'=>$request->get('nivel')));
            }
        }
        return $this->render('AppBundle::reportes-select.html.twig',array('niveles'=>$niveles,'chart' => $ob,'selected'=>'aprob','selectedNivel'=>$request->get('nivel')));

    }
    /**
     * @Route("/graficos2",name="graf2")
     */
    public function graficos2Action(Request $request){
        $em=$this->getDoctrine()->getManager();
        //Modulo
        $modulos=$em->getRepository('AppBundle:Modulo')->findAll();
        $ob=new Highchart();
        if($request->isMethod("POST")){
            $niveles=$em->getRepository('AppBundle:Modulo')->find($request->get('modulo'));
            if($request->get('grafico')=='aprob') {
                $ob=$this->graficoAprobados($request->get('nivel'));
                return $this->render('AppBundle::reportes-select.html.twig', array('modulos'=>$modulos,'selectedModulo'=>$request->get('modulo'),'niveles' => $niveles, 'chart' => $ob,'selected'=>'aprob','selectedNivel'=>$request->get('nivel')));
            }
            if($request->get('grafico')=='act'){
                $ob=$this->graficaActivos();
                return $this->render('AppBundle::reportes-select.html.twig',array('modulos'=>$modulos,'selectedModulo'=>$request->get('modulo'),'niveles'=>$niveles,'chart' => $ob,'selected'=>'act','selectedNivel'=>$request->get('nivel')));
            }
            if($request->get('grafico')=='not'){
                return $this->redirectToRoute('graficoAlumno',array('nivel'=>$request->get('nivel'),'mod'=>$request->get('modulo')));
            }
            return $this->render('AppBundle::reportes-select.html.twig',array('modulos'=>$modulos,'selectedModulo'=>$request->get('modulo'),'niveles'=>$niveles,'chart' => $ob,'selected'=>'aprob','selectedNivel'=>$request->get('nivel')));

        }
        return $this->render('AppBundle::reportes-select.html.twig',array('modulos'=>$modulos,'selectedModulo'=>'','niveles'=>'','chart' => $ob,'selected'=>'','selectedNivel'=>''));
    }
    private function graficoPastel(){
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'),
            'showInLegend'  => true
        ));
        return $ob;
    }
    private  function graficoAprobados($nivel){
        $ob=$this->graficoPastel();
        if($nivel==0)
            $ob->title->text('Porcentaje de Alumnos Aprobados/Reprobados en CENIUES ');
        else
            $ob->title->text('Porcentaje de Alumnos Aprobados/Reprobados ');
        //Logica
        $em=$this->getDoctrine()->getManager();
        if($nivel==0)
            $matricula=$em->getRepository('AppBundle:Matricula')->findBy(array('esactivo'=>1));
        else
            $matricula=$em->getRepository('AppBundle:Matricula')->findBy(array('esactivo'=>1,'nivelnivel'=>$this->getDoctrine()->getRepository('AppBundle:Nivel')->find($nivel)));
        $total=0;
        $aprob=0;
        if($matricula){
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
        }
        else{
            $data = array(
                array('Alumnos Aprobados '.(0), 0),
                array('Alumnos Reprobados '.(0), 100),
            );
        }
        $ob->series(array(array('type' => 'pie','name' => 'Porcentaje', 'data' => $data)));
        return $ob;
    }
    private function graficaActivos(){
        $ob=$this->graficoPastel();
        $ob->title->text('Porcentaje de Alumnos Activos/Inactivos');
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
        return $ob;
    }
}

