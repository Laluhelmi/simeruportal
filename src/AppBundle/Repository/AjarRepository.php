<?php
namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

class AjarRepository extends EntityRepository{
  public function findAllByprodi($idprodi)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT a,m,p FROM AppBundle:Ajar a
                JOIN a.matakuliahmatkul m
               "JOIN ; 
            )
            ->getResult();
        return $query;
  }
}

?>
