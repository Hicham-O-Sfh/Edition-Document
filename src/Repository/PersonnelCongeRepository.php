<?php

namespace App\Repository;

use App\Entity\PersonnelConge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonnelConge|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelConge|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelConge[]    findAll()
 * @method PersonnelConge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelCongeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnelConge::class);
    }

    // /**
    //  * @return PersonnelConge[] Returns an array of PersonnelConge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PersonnelConge
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
