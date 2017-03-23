<?php
namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

class AkunRepository extends EntityRepository{
  public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Akun p ORDER BY p.nama ASC'
            )
            ->getResult();

  }
}

?>
