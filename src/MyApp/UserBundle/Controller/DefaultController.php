<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@FOSUser/Security/login.html.twig');
    }
    public function clientAction()
    {
        return $this->render('@MyAppUser/pages/pageclient.html.twig');
    }
    public function gerantAction()
    {
        return $this->render('@MyAppUser/pages/gerant.html.twig');
    }
    public function homeAction(){
        return $this->render("::frontbase.html.twig");
    }
}
