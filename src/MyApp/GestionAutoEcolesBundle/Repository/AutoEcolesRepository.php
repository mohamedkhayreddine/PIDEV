<?php
namespace MyApp\GestionAutoEcolesBundle\Repository;
use MyApp\UserBundle\Entity\AutoEcoles;
use MyApp\UserBundle\Entity\Ville;

/**
 * Created by PhpStorm.
 * User: fakhri
 * Date: 03/04/2017
 * Time: 11:48
 */
class AutoEcolesRepository extends  \Doctrine\ORM\EntityRepository
{
function rech()
{        $query=$this->getEntityManager()
               ->createQuery("SELECT p.laltitude , p.longitude FROM MyAppUserBundle:AutoEcoles a JOIN MyAppUserBundle:AutoEcoles p WHERE a.idVille=p.id ");



    return $query->getQuery()->getResult();
}
    function findDQL()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM MyAppUserBundle:AutoEcoles a ");

        return $query->getResult();

    }


}