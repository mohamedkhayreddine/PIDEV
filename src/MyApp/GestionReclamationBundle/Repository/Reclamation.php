<?php

/**
 * Created by PhpStorm.
 * User: Aycha
 * Date: 27/03/2017
 * Time: 01:00
 */
namespace MyApp\GestionReclamationBundle\Repository;
use Doctrine\ORM\EntityRepository;
class Reclamation extends EntityRepository
{
    public function affichereclamationuser($con)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionReclamationBundle:Reclamation s where s.idcandidat=:con");
        $query->setParameter('con', $con);
        return $query->getResult();

    }

    public function stat($b)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        SELECT COUNT(o.matricule) AS  sauto FROM MyAppGestionReclamationBundle:Reclamation o WHERE o.statut = :b");
        $query->setParameter('b', $b);
        return $query->getSingleScalarResult() ;

    }
    public function statRef($a)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        SELECT COUNT(o.matricule) AS  sauto FROM MyAppGestionReclamationBundle:Reclamation o WHERE o.statut = :a");
        $query->setParameter('a', $a);
        return $query->getSingleScalarResult() ;

    }
    public function statTrai($c)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        SELECT COUNT(o.matricule) AS  sauto FROM MyAppGestionReclamationBundle:Reclamation o WHERE o.statut = :c");
        $query->setParameter('c', $c);
        return $query->getSingleScalarResult() ;

    }
    public function recherche($con,$nom)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionReclamationBundle:Reclamation s where s.titrerec like :nom and s.idcandidat=:con or s.statut like :nom and s.idcandidat=:con");
        $query->setParameter('con', $con);
        $query->setParameter('nom', '%'.$nom.'%');

        return $query->getResult();

    }

    function findDQL($con)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM MyAppGestionReclamationBundle:Reclamation a where a.idcandidat=:con ORDER BY a.dateReclamation DESC");
        $query->setParameter('con', $con);
        return $query->getResult();

    }
}