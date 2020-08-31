<?php

namespace App\Repository;

use App\Entity\ListAffectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListAffectation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListAffectation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListAffectation[]    findAll()
 * @method ListAffectation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListAffectationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListAffectation::class);
    }

    // /**
    //  * @return ListAffectation[] Returns an array of ListAffectation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListAffectation
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
