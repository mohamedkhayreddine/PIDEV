<?php

namespace MyApp\GestionSeanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppGestionSeanceBundle:Default:index.html.twig');
    }
}
