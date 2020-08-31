<?php

namespace App\Repository;

use App\Entity\PersonnelDocumentExterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonnelDocumentExterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelDocumentExterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelDocumentExterne[]    findAll()
 * @method PersonnelDocumentExterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelDocumentExterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnelDocumentExterne::class);
    }

    // /**
    //  * @return PersonnelDocumentExterne[] Returns an array of PersonnelDocumentExterne objects
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
    public function findOneBySomeField($value): ?PersonnelDocumentExterne
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
