<?php

namespace MyApp\CarteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppCarteBundle:Default:index.html.twig');
    }
}
