<?php
/**
 * Created by PhpStorm.
 * User: Kcrez
 * Date: 20/9/2015
 * Time: 8:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Docente;
use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DocenteController extends Controller
{
    /**
     * @Route("/admin/docentes", name="dhome")
     */
    public function docenteHomeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->isMethod("POST")) {
            $docentes = $em->getRepository('AppBundle:Docente')->find($request->get("carnet"));
            $docente = array($docentes);
            if(!$docentes)
            {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>3 )));
            }
            return $this->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docente, 'mensaje'=>10));
        }
        else {
            $docentes = $em->getRepository('AppBundle:Docente')->findAll();
            if($request->get('estado') == 1) {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>1 )));
            }
            elseif($request->get('estado') == 2) {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>2 )));
            }
            elseif($request->get('estado') == 4) {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>4 )));
            }
            elseif($request->get('estado') == 5) {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>5 )));
            }
            elseif(!$docentes)
            {
                return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>3 )));
            }
            return new Response($this->container->get('templating')->render('AppBundle:docente:gestionarDocente.html.twig', array('docentes'=>$docentes, 'mensaje'=>null)));
        }
    }

    /**
     * @Route("/admin/adocentes", name="agregarD")
     */
    public function agregarDocenteAction(Request $request)
    {
        if($request->isMethod("POST")){
            $em=$this->getDoctrine()->getManager();

            //Verificar existencia de docente
            if($em->getRepository('AppBundle:Docente')->find($request->get("cdoc"))) {
                return $this->redirectToRoute('dhome', array('estado'=>1));
            }

            //Creando nuevo docente
            $d = new Docente();
            $d->setNombredocente($request->get("ndoc"));
            $d->setApellidodocente($request->get("adoc"));
            $d->setDui($request->get("ddoc"));
            $d->setDirecciondocente($request->get("ddoc"));
            $d->setCarnetdocente($request->get("cdoc"));
            $d->setTelefono($request->get("tdoc"));
            $d->setFechanacimiento(new \DateTime($request->get("fdoc")));
            $d->setEstado(1);

            $em->persist($d);
            $em->flush();

            //Creando usuario docente
            $u = new Usuario();
            $u->setNomusuario($request->get("cdoc"));
            $u->setIsactive(1);
            $u->setTipoUsuariotipoUsuario($em->getRepository('AppBundle:TipoUsuario')->find(3));
            $u->setEmailusuario($request->get("edoc"));
            //Cifra la contraseña
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($u);
            $password = $encoder->encodePassword($request->get("cdoc"), $u->getSalt());
            $u->setPassword($password);

            $em->persist($u);
            $em->flush();

            return $this->redirectToRoute('dhome', array('estado'=>2));
        }
        else {
            return $this->render('AppBundle:docente:creardocente.html.twig');
        }
    }

    /**
     * @Route("/admin/cdocente", name="consultarD")
     */
    public function consultarDocenteAction(Request $request)
    {
        if($request->isMethod("POST")) {
            $em = $this->getDoctrine()->getManager();
            $docentes = $em->getRepository('AppBundle:Docente')->find($request->get("parB"));
            $docente = array($docentes);
            if(!$docentes)
            {
                return $this->render('AppBundle:docente:buscardocente.html.twig', array('docentes'=>$docentes ));
            }
            return $this->render('AppBundle:docente:buscardocente.html.twig', array('docentes'=>$docente));
        }
        return $this->render('AppBundle:docente:buscardocente.html.twig', array('docentes'=>null));
    }

    /**
     * @Route("/admin/mdocente/{carnet}", name="modificarD")
     */
    public function modificarDocenteAction(Request $request, $carnet)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod("POST")) {
            //verificar existencia
            if($em->getRepository('AppBundle:Docente')->find($request->get("cdoc"))) {
                return $this->redirectToRoute('dhome', array('estado'=>4));
            }

            //Actualizando docente
            $d = $em->getRepository('AppBundle:Docente')->find($carnet);
            $d->setNombredocente($request->get("ndoc"));
            $d->setApellidodocente($request->get("adoc"));
            $d->setDui($request->get("ddoc"));
            $d->setDirecciondocente($request->get("ddoc"));
            $d->setCarnetdocente($request->get("cdoc"));
            $d->setTelefono($request->get("tdoc"));
            $d->setFechanacimiento(new \DateTime($request->get("fdoc")));
            $d->setEstado(1);

            $em->persist($d);
            $em->flush();

            //Modificando usuario docente
            if($this->getDoctrine()->getRepository('AppBundle:Usuario')->findOneBy(array('nomusuario'=>$request->get("cdoc")))) {
                $u = $em->getRepository('AppBundle:Usuario')->findOneBy(array('carnetdocente'=>$carnet));
            }
            else { //crear usuario si no existe
                $u = new Usuario();
            }

            $u->setNomusuario($request->get("cdoc"));
            $u->setIsactive(1);
            $u->setTipoUsuariotipoUsuario($em->getRepository('AppBundle:TipoUsuario')->find(3));
            $u->setEmailusuario($request->get("edoc"));
            //Cifra la contraseña
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($u);
            $password = $encoder->encodePassword($request->get("cdoc"), $u->getSalt());
            $u->setPassword($password);

            $em->persist($u);
            $em->flush();

            return $this->redirectToRoute('dhome', array('estado'=>5));
        }
        else {
            $docentes = $em->getRepository('AppBundle:Docente')->findOneBy(array('carnetdocente'=>$request->get("carnet")));
            $email = $this->getDoctrine()->getRepository('AppBundle:Usuario')->findOneBy(array('nomusuario'=>$request->get("carnet")));
            $html = $this->container->get('templating')->render('AppBundle:docente:pdoc.html.twig', array('docente' => $docentes, 'correo' => $email, 'carnet' => $carnet));

            return new Response($html);
        }
    }

    /**
     * @Route("/admin/dnivel", name="docn")
     */
    public function docenteNivelAction()
    {
        $em = $this->getDoctrine()->getManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();
        $locales = $em->getRepository('AppBundle:Local')->findAll();
        $niveles = $em->getRepository('AppBundle:Nivel')->findAll();
        $secciones = $em->getRepository('AppBundle:Seccion')->findAll();
        $clases = $em->getRepository('AppBundle:Clase')->findAll();

        if(!$docentes)
        {
            return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>1)));
        }
        elseif(!$locales||!$niveles)
        {
            return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>2)));
        }
        elseif(!$niveles)
        {
            return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>3)));
        }
        elseif(!$secciones)
        {
            return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>4)));
        }
        elseif(!$clases)
        {
            return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>5)));
        }

        /*foreach($docentes as $docente){
            foreach($locales as $local) {
                foreach($niveles as $nivel) {
                    foreach($secciones as $seccion) {
                        foreach($clases as $clase){
                        }
                    }
                }
            }
        }*/

        return new Response($this->container->get('templating')->render('AppBundle:docente:docenteNivel.html.twig', array('form'=>$docentes, 'error'=>null)));
    }

    /**
     * @Route("/admin/edocente", name="eliminarD")
     */
    public function eliminarDocenteAction(Request $request)
    {
        $id = $request->get("crnE");
        $em=$this->getDoctrine()->getManager();
        $docente = $em->getRepository('AppBundle:Docente')->find($id);
        $docente->setEstado(0);
        $em->flush();
        return $this->redirectToRoute('dhome');
    }

    /**
     * @Route("/admin/adocente", name="activarD")
     */
    public function activarDocenteAction(Request $request)
    {
        $id = $request->get("carnet");
        $em=$this->getDoctrine()->getManager();
        $docente = $em->getRepository('AppBundle:Docente')->find($id);
        $docente->setEstado(1);
        $em->flush();
        return $this->redirectToRoute('dhome');
    }

    /**
     * @Route("/ldocente", name="documentoD")
     */
    public function reporteDocenteAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();

        if(!$docentes)
        {
            throw $this->createNotFoundException('No se encontro ningun docente');
        }
        return new Response($this->container->get('templating')->render('AppBundle:reportes:listadoDocentes.html.twig', array('TituloPagina' => 'Docentes inscritos', 'form' => $docentes)));
    }

    /**
     * @Route("/admin/detallesD", name="detallesD")
     */
    public function detallesPorCarnetAction(Request $request){
        $dui = $request->get('duidocente');
        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository('AppBundle:Docente');
        $docente = $em->getRepository('AppBundle:Docente')->findOneBy(array('dui'=>$dui));

        $envio = array("carnetdoc"=>$docente->getCarnetdocente(),
            "nombre"=>$docente->getNombredocente(),
            "apellido"=>$docente->getApellidodocente(),
            "duidoc"=>$docente->getDui(),
            "direccion"=>$docente->getDirecciondocente(),
            "fnac"=>$docente->getFechanacimiento()->format('Y-m-d'),
            "ntel"=>$docente->getTelefono());

        return new JsonResponse($envio);
    }

    /**
     * @Route("/defHor", name="definirH")
     */
    public function definirHorarioAction(Request $request) {
        if($request->isMethod("POST")) {
            $em = $this->getDoctrine()->getManager();
            if($this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRADOR')) {
                $buscar = $em->getRepository("AppBundle:Docente")->find($request->get('parB'));
                if(!$buscar) {
                    return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>'2'));
                }
                $envio = $buscar->getCarnetdocente();
                return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>$envio));
            }
            else {
                return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>null));
            }
        }
        elseif($this->get('security.authorization_checker')->isGranted('ROLE_DOCENTE')) {
            return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>'1'));
        }
        else {
            return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>null));
        }
    }

    /**
     * @Route("/gHor", name="guardarH")
     */
    public function guardarHorarioAction(Request $request) {
        if($request->isMethod("POST")) {
            $em = $this->getDoctrine()->getManager();
            $d = $em->getRepository("AppBundle:Docente")->find($request->get('crnt'));
            if(!$d) {
                return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>'4'));
            }
            $hm = $request->get('horS').":".$request->get('minS')."-am";
            $hv = $request->get('hor2').":".$request->get('min2')."-pm";
            $sabD = $request->get('sabD');
            $domD = $request->get('domD');
            $d->setDiasD($hm." ".$hv);
            $d->setHorasD($sabD." ".$domD);
            $em->flush();
            return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>'3'));
        }
        else {
            return $this->render("@App/docente/definirHorario.html.twig", array('docente'=>null));
        }
    }
}