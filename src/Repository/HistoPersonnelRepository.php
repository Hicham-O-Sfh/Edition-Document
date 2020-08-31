<?php

namespace App\Repository;

use App\Entity\HistoPersonnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoPersonnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoPersonnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoPersonnel[]    findAll()
 * @method HistoPersonnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoPersonnelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoPersonnel::class);
    }

    // /**
    //  * @return HistoPersonnel[] Returns an array of HistoPersonnel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoPersonnel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
