<?php

namespace MyApp\GestionOffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionOffresBundle:Default:index.html.twig');
    }
}
