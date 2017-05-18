<?php
namespace MyApp\EventsBundle\Repository ;
use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 30/03/2017
 * Time: 14:40
 */
class EventsRepository extends EntityRepository
{
    public function findPublicEvents()
    {
        $query = $this->createQueryBuilder('s');
        $query->where("s.access=:access")->setParameter('access','public');
        return $query->getQuery()->getResult();

    }
    public function TrierEvents()
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppEventsBundle:Event s ORDER BY s.eventDate");

        return $query->getResult();

    }


}