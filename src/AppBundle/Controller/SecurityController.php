<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $error = null;

        $authenticationUtils = $this->get('security.authentication_utils');

        //obtenemos el error del login si hay alguno
        $error = $authenticationUtils->getLastAuthenticationError();

        //obtenemos el ultimo nombre de usuario ingresado
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error));

        //Preguntar como redirigir de el formulario del login a otra pag.

    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        /*if ($this->get('session')->has("_security_default")) {
            return $this->redirectToRoute("principal");
        } else {
            return $this->redirectToRoute("login");
        }*/
    }

}