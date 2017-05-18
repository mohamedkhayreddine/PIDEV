<?php

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 28/03/2017
 * Time: 16:48
 */
namespace MyApp\QuestionBundle\Repository;
use Doctrine\ORM\EntityRepository;



class QuestionRepository extends EntityRepository
{

    public function findQuestionDQL($contenu){

        $query = $this->getEntityManager()->
        createQuery("select q from MyAppQuestionBundle:Question q WHERE q.contenu LIKE :contenu")->
        setParameter('contenu','%'.$contenu.'%');

        return $query->getResult();
    }

    public function recupereraléatoirement($type){
        $query = $this->getEntityManager()->
        createQuery()->setParameter('','');
        return $query->getResult();
    }
}