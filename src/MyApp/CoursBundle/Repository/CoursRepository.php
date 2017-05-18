<?php
namespace  MyApp\CoursBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CoursRepository extends EntityRepository
{


    public function findCourPropose()
    {
        $query =$this->getEntityManager()->createQuery("select c from MyAppCoursBundle:Cours c WHERE  c.idMoniteur is not NULL ") ;

        return $query->getResult();
    }

    public function findCourValider()
    {
        $query =$this->getEntityManager()->createQuery("select c from MyAppCoursBundle:Cours c WHERE  c.validation=1 ") ;

        return $query->getResult();
    }


    public function findCourMoniteur($moniteur)
    {
        $query =$this->getEntityManager()->createQuery("select c from MyAppCoursBundle:Cours c WHERE  c.idMoniteur=:moniteur")
            ->setParameter('moniteur',$moniteur);

        return $query->getResult();
    }


    public function findCourAdmin()
    {
        $query =$this->getEntityManager()->createQuery("select c from MyAppCoursBundle:Cours c WHERE c.idMoniteur is NULL ");

        return $query->getResult();
    }

    public function countCourAdmin()
    {
        $query =$this->getEntityManager()->createQuery("select count(c) , month(c.dateDepo) as month_x from MyAppCoursBundle:Cours c WHERE c.idMoniteur is NULL group by month_x ");

        return $query->getResult();
    }

    public function countCourMoniteur()
    {
        $query =$this->getEntityManager()->createQuery("select count(c) , month(c.dateDepo) as month_x from MyAppCoursBundle:Cours c  WHERE c.idMoniteur is NOT NULL  group by month_x ");
        // $query =$this->getEntityManager()->createQuery("select count(c) as cour  , month(c.dateDepo)  as day_x from MyAppCoursBundle:Cours c  group by day_x");


        return $query->getResult();
    }

    public function countCourParMois()
    {
        $query =$this->getEntityManager()->createQuery("select count(c) as cour  , month(c.dateDepo) as day_x from MyAppCoursBundle:Cours c  group by day_x");
        return $query->getArrayResult();
    }
    public function rechercheCoursLike($motCle)
    {

        $query = $this->getEntityManager()->createQuery("SELECT c FROM MyAppCoursBundle:Cours c  WHERE c.titre LIKE :F ")
            ->setParameter('F','%'.$motCle.'%');
        return $query->getResult();
    }


}