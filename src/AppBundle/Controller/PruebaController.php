<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/prueba", name="prueba")
     */
    public function indexAction(Request $request)
    {
        //A ver si sale
        //Si lo ves funciona
        // y si no? LLora
        return new Response('');

    }

    /**
     * @Route ("/prueba2")
     */

    public function pruebaAction()
    {
        //Si lo ves funciona 2.0

        return $this->render('');
    }
}