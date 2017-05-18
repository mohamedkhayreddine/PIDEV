<?php

namespace MyApp\GestionReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppGestionReclamationBundle:Default:index.html.twig');
    }
}
