<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction()
    {
        return $this->render(':default:basefront.html.twig');
    }

    public function BackAction()
    {
        return $this->render(':default:baseEnd.html.twig');
    }

    public function gerantAction()
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');

        return $this->render('@MyAppUser/Default/pages/gerant.html.twig');
    }

    public function ClientAction()
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        return $this->render('MyAppUserBundle:Default/pages:user.html.twig');
    }

    public function MoniteurAction()
    {
        $this->denyAccessUnlessGranted('ROLE_MONITEUR');

        return $this->render('@MyAppUser/Default/pages/moniteur.html.twig');
    }
    public function AdminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('@MyAppUser/Default/pages/admin.html.twig');
    }
}
