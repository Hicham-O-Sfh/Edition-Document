<?php

namespace App\Repository;

use App\Entity\MouvementPersonnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MouvementPersonnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method MouvementPersonnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method MouvementPersonnel[]    findAll()
 * @method MouvementPersonnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementPersonnelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MouvementPersonnel::class);
    }

    // /**
    //  * @return MouvementPersonnel[] Returns an array of MouvementPersonnel objects
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
    public function findOneBySomeField($value): ?MouvementPersonnel
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
