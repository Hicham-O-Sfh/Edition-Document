<?php

namespace App\Repository;

use App\Entity\DocumentExterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentExterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentExterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentExterne[]    findAll()
 * @method DocumentExterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentExterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentExterne::class);
    }

    // /**
    //  * @return DocumentExterne[] Returns an array of DocumentExterne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocumentExterne
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
