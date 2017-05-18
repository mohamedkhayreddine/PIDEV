<?php

namespace MyApp\AffectationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppAffectationBundle:Default:index.html.twig');
    }
}
