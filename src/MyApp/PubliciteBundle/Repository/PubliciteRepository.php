<?php

namespace MyApp\PubliciteBundle\Repository;
use Doctrine\ORM\EntityRepository;



class PubliciteRepository extends EntityRepository
{

    public function findPubPropose()
    {
        $query =$this->getEntityManager()->createQuery("select p from MyAppPubliciteBundle:Publicite p WHERE  p.validation=0") ;

        return $query->getResult();
    }


    public function findMesPub($owner)
    {
        $query =$this->getEntityManager()->createQuery("select p from MyAppPubliciteBundle:Publicite p WHERE  p.idowner=:owner")
            ->setParameter('owner',$owner);

        return $query->getResult();
    }

}