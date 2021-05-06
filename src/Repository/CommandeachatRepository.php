<?php

namespace App\Repository;

use App\Entity\Commandeachat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commandeachat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandeachat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandeachat[]    findAll()
 * @method Commandeachat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeachatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandeachat::class);
    }

    // /**
    //  * @return Commandeachat[] Returns an array of Commandeachat objects
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
    public function findOneBySomeField($value): ?Commandeachat
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
