<?php

namespace App\Repository;

use App\Entity\NatureConge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureConge|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureConge|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureConge[]    findAll()
 * @method NatureConge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureCongeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureConge::class);
    }

    // /**
    //  * @return NatureConge[] Returns an array of NatureConge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NatureConge
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
