<?php

namespace App\Repository;

use App\Entity\Paiment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paiment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paiment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paiment[]    findAll()
 * @method Paiment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiment::class);
    }

    // /**
    //  * @return Paiment[] Returns an array of Paiment objects
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
    public function findOneBySomeField($value): ?Paiment
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
