<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PruebaController extends Controller
{
    /**
     * @Route("/prubeGit")
     */
    public function indexAction()
    {
        return new Response('');
    }
}
