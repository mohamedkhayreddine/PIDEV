<?php
namespace MyApp\GestionSeanceBundle\Repository;
use  Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 22/03/2017
 * Time: 11:04
 */
class SeanceRepository extends  EntityRepository
{
    public function findUserSeance($id)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionSeanceBundle:Seance s where s.idCandidat=:id");
        $query->setParameter('id', $id);
        return $query->getResult();
    }
    public function rechercheSeance($motcle)
    {
        $query = $this->createQuery
        ("SELECT m FROM MyAppGestionSeanceBundle:Seance m WHERE m.id_moniteur OR m.id_candidat OR m.date_seance LIKE '$motcle%'");
         return $query->getResult();

    }
    public function trierSeancesParDate()
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionSeanceBundle:Seance s ORDER BY s.dateSeance");

        return $query->getResult();

    }
    public function findMoniteurSeance($id)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        select s  from MyAppGestionSeanceBundle:Seance s where s.idMoniteur =:id");
        $query->setParameter('id', $id);
        return $query->getResult();
    }
    public function findSeanceBydate($motcle)
    {
        $query = $this->getEntityManager()
            ->createQuery("
            SELECT s FROM MyAppGestionSeanceBundle:Seance s wherer s.date_seance LIKE '%$motcle%' ");

        return $query->getResult();
    }
}