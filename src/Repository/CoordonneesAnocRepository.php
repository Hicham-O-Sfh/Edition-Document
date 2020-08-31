<?php

namespace App\Repository;

use App\Entity\CoordonneesAnoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoordonneesAnoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordonneesAnoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordonneesAnoc[]    findAll()
 * @method CoordonneesAnoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordonneesAnocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoordonneesAnoc::class);
    }

    // /**
    //  * @return CoordonneesAnoc[] Returns an array of CoordonneesAnoc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoordonneesAnoc
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
