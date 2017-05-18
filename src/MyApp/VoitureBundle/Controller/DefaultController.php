<?php

namespace MyApp\VoitureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppVoitureBundle:Default:index.html.twig');
    }
}
