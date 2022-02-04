<?php

namespace App\Repository;

use App\Entity\DofusRessource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DofusRessource|null find($id, $lockMode = null, $lockVersion = null)
 * @method DofusRessource|null findOneBy(array $criteria, array $orderBy = null)
 * @method DofusRessource[]    findAll()
 * @method DofusRessource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DofusRessourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DofusRessource::class);
    }

    // /**
    //  * @return DofusRessource[] Returns an array of DofusRessource objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DofusRessource
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
