<?php
namespace MyApp\GestionOffresBundle\Repository;
use MyApp\UserBundle\Entity\Offres;

/**
 * Created by PhpStorm.
 * User: fakhri
 * Date: 12/04/2017
 * Time: 01:38
 */
class OffresRepository extends \Doctrine\ORM\EntityRepository
{
    public function recherche($nom)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionReclamationBundle:Offres s where s.titre like :nom");
        $query->setParameter('nom', '%' . $nom . '%');

        return $query->getResult();
    }
    function sear()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT o FROM MyAppUserBundle:Offres o ");

        return $query->getResult();

    }
}