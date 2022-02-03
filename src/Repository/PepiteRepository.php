<?php

namespace App\Repository;

use App\Entity\Pepite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pepite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pepite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pepite[]    findAll()
 * @method Pepite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PepiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pepite::class);
    }

    // /**
    //  * @return Pepite[] Returns an array of Pepite objects
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
    public function findOneBySomeField($value): ?Pepite
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
