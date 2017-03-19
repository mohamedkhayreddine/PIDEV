<?php

namespace MyApp\GestionEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppGestionEventBundle:Default:index.html.twig');
    }
}
