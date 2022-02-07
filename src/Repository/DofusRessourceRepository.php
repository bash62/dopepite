<?php

namespace App\Repository;

use App\Entity\DofusRessource;
use App\Entity\RessourceEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

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

    public function findAllNotGiveByUser($ids) : array
    {

        $qb2 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->where($this->createQueryBuilder('r')->expr()->notIn('r.id',$ids))
            ->getQuery();
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb1 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->where($this->createQueryBuilder('r')->expr()->notIn('r.id',$ids))
            ->getQuery();

        return $qb1->execute();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }

    public function findAllNoUser() : array
    {
        $qb1 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->getQuery();

        return $qb1->execute();


        // $product = $query->setMaxResults(1)->getOneOrNullResult();
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
