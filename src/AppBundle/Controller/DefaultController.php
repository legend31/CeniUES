<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel;
use AppBundle\Entity\Usuario;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/admin/principal", name="principal")
     */
    public function principalAction(){
        return $this->render('AppBundle:admin:vPrincipal.html.twig');
    }

    /**
     * @Route("/listaalumnos", name="listaalumno")
     */
    public function listaAlumno(){
        return $this->render('AppBundle:reportes:listadoalumnos.html.twig');
    }
    /**
     * @Route("/record",name="record")
     */
    public function recordAction(){
        /*$recodA=$this->getDoctrine()->getRepository('AppBundle:Recordalumno')->find(1);
        $record=$this->getDoctrine()->getRepository('AppBundle:Record')->find(1);
        var_dump($record->getNivelnivel());*/
        $n=$this->getDoctrine()->getRepository('AppBundle:Nivel')->find(1);
        $s=$this->getDoctrine()->getRepository('AppBundle:Seccion')->find(1);
        //$s->getIdseccion()
        $a=$n->getSeccionseccion()->toArray();
        foreach($a as $ar){
            echo "<br>".$ar->getIdseccion();
        }
        return new Response();
    }

    //FUNCION ENCARGADA DE REALIZAR EL REDIRECCIONAMIENTO A LA PANTALLA PRINCIPAL PARA C/U DE LOS USUARIOS
    /**
     * @Route("/control", name="control_redirect")
     */
    public function controlRedirectAction(){
        if(true == $this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRADOR')){
            return $this->redirectToRoute("principal");
        }else{
            if(true == $this->get('security.authorization_checker')->isGranted('ROLE_DOCENTE')){
                return $this->redirectToRoute("docprincipal");
            }else{
                return $this->redirectToRoute("login");
            }
        }
    }
    /**
     * @Route("/admin/registrar",name="reg")
     */
    public function registrarAdminAction(Request $request){
        /*$em=$this->getDoctrine()->getManager();
        $user=new Usuario();
        $user->setTipoUsuariotipoUsuario($em->getRepository('AppBundle:TipoUsuario')->find(1));
        $user->setNomusuario("juan");
        $user->setEmailusuario("j@b.com");
        $user->setIsactive(1);
        //Cifra la contraseña
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword("456", $user->getSalt());

        $user->setPassword($password);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('principal');*/

        /*$user=$this->get('security.token_storage')->getToken()->getUser();
        var_dump($user->getNomusuario());
        return new Response();*/
        $em=$this->getDoctrine()->getManager();
        $niveles=$em->getRepository('AppBundle:Nivel')->findAll();

        $ob=$this->graficoAprobados();
        if($request->isMethod("POST")){
           if($request->get('grafico')=='aprob')
               return $this->render('AppBundle::reportes-select.html.twig',array('niveles'=>$niveles,'chart' => $ob));
           if($request->get('grafico')=='act'){
               $ob=$this->graficaActivos();
               return $this->render('AppBundle::reportes-select.html.twig',array('niveles'=>$niveles,'chart' => $ob));
           }
            if($request->get('grafico')=='not'){
                return $this->redirectToRoute('graficoAlumno');
            }
        }
        return $this->render('AppBundle::reportes-select.html.twig',array('niveles'=>$niveles,'chart' => $ob));

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
    private  function graficoAprobados(){
       $ob=$this->graficoPastel();
        $ob->title->text('Porcentaje de Alumnos Aprobados/Reprobados');
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
