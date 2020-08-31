<?php

namespace App\Repository;

use App\Entity\MotifRejet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MotifRejet|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotifRejet|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotifRejet[]    findAll()
 * @method MotifRejet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotifRejetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotifRejet::class);
    }

    // /**
    //  * @return MotifRejet[] Returns an array of MotifRejet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotifRejet
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
