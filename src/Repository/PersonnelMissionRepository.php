<?php

namespace App\Repository;

use App\Entity\PersonnelMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonnelMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelMission[]    findAll()
 * @method PersonnelMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnelMission::class);
    }

    // /**
    //  * @return PersonnelMission[] Returns an array of PersonnelMission objects
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
    public function findOneBySomeField($value): ?PersonnelMission
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
