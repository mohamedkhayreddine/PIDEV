<?php

namespace MyApp\GestionVilleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppGestionVilleBundle:Default:index.html.twig');
    }
}
