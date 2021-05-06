<?php

namespace App\Repository;

use App\Entity\Commandevente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commandevente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandevente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandevente[]    findAll()
 * @method Commandevente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeventeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandevente::class);
    }

    // /**
    //  * @return Commandevente[] Returns an array of Commandevente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commandevente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
