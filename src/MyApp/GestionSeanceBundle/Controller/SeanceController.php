<?php

namespace MyApp\GestionSeanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeanceController extends Controller
{
    public function AccueilAction()
    {
        return $this->render("MyAppGestionSeanceBundle:Seance:Acceuil.html.twig");

    }
    public function ajoutAction()
    {
        return $this->render("MyAppGestionSeanceBundle:Seance:ajoutseance.html.twig");
    }
    public function affichageAction()
    {
        return $this->render("MyAppGestionSeanceBundle:Seance:affichageseance.html.twig");
    }
}
