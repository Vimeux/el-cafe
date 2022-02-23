<?php

namespace App\Repository;

use App\Entity\SeedType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeedType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeedType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeedType[]    findAll()
 * @method SeedType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeedTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeedType::class);
    }

    // /**
    //  * @return SeedType[] Returns an array of SeedType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SeedType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
