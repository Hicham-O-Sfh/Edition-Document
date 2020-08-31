<?php

namespace App\Repository;

use App\Entity\PersonnelDiplome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonnelDiplome|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelDiplome|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelDiplome[]    findAll()
 * @method PersonnelDiplome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelDiplomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnelDiplome::class);
    }

    // /**
    //  * @return PersonnelDiplome[] Returns an array of PersonnelDiplome objects
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
    public function findOneBySomeField($value): ?PersonnelDiplome
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
