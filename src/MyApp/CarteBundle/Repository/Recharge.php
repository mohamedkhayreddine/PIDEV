<?php

/**
 * Created by PhpStorm.
 * User: Aycha
 * Date: 27/03/2017
 * Time: 01:00
 */
namespace MyApp\CarteBundle\Repository;
use Doctrine\ORM\EntityRepository;
class Recharge extends EntityRepository
{
    public function rechercheCarte($numRecharge)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select (s.solde)  from MyAppCarteBundle:Recharge s where s.numRecharge=:numRecharge");
        $query->setParameter('numRecharge', $numRecharge);
        return $query->getSingleScalarResult();

    }

    public function recherchevalideCarte($numRecharge)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select (s.valide)  from MyAppCarteBundle:Recharge s where s.numRecharge=:numRecharge");
        $query->setParameter('numRecharge', $numRecharge);
        return $query->getSingleScalarResult();

    }

    public function modif($numRecharge)
    {
        $query = $this->getEntityManager()->createQuery(
            'update MyAppCarteBundle:Recharge p set p.valide=:b where p.numRecharge=:numRecharge');

        $query->setParameter('b', '1');
        $query->setParameter('numRecharge', $numRecharge);


        $query->execute();


    }
}








