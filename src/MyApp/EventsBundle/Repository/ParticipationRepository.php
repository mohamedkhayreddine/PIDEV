<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 30/03/2017
 * Time: 16:01
 */

namespace MyApp\EventsBundle\Repository;
use Doctrine\ORM\EntityRepository;

class ParticipationRepository extends EntityRepository
{
  public function FindParticipants($id)
  {
      $query = $this->createQueryBuilder('s');
      $query->where("s.event=:event_id")->setParameter('event_id',$id);
      return $query->getQuery()->getResult();
  }

    /**
     * @param $idp
     * @param $ide
     * @return mixed
     */
    public function Existe($idp, $ide)
  {
      $query = $this->createQueryBuilder('s');
      $query->where("s.event=:event_id")->andWhere('s.user=:user_id')->setParameters(array('event_id'=>$ide,'user_id'=>$idp));
      return $query->getQuery()->getResult();
  }
}