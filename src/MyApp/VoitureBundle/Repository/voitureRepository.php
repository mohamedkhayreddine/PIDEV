<?php

namespace MyApp\VoitureBundle\Repository;
use Doctrine\ORM\EntityRepository ;
class voitureRepository extends  EntityRepository
{

    public function findvoitureParameter($motCle)
    {
        $query=$this->getEntityManager()->createQuery("select m from 'VoitureBundle:voiture' m  where m.serie=:motCle or m.model=:motCle or m.marque=:motCle or m.couleur=:motCle")
            ->setParameter('motCle',$motCle);
        return $query->getResult();

    }
}