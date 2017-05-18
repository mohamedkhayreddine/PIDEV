<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 31/03/2017
 * Time: 17:32
 */

namespace MyApp\QuestionBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReponseQuestionRepository extends EntityRepository
{

    public function findQuestByTypeAndUser($user,$type)
    {
        $query = $this->getEntityManager()->
        createQuery("select q from MyAppQuestionBundle:ReponseQuestion q WHERE q.TypeQuestion=:TypeQuestion AND q.User=:utilisateur")->
        setParameter('TypeQuestion',$type)->setParameter('utilisateur',$user);

        return $query->getResult();

    }
}