<?php

namespace MyApp\paiementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyApppaiementBundle:Default:index.html.twig');
    }
}
