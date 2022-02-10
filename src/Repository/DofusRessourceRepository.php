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

        $qb1 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->where($this->createQueryBuilder('r')->expr()->notIn('r.id',$ids))
            ->andWhere('r.available is null ')
            ->getQuery();

        return $qb1->execute();

    }

    public function findAllGiveByUser($ids) : array
    {


        $qb1 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->where($this->createQueryBuilder('r')->expr()->In('r.id',$ids))
            ->getQuery();

        return $qb1->execute();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }

    /**
     * Find all object to display in BDD not archived //
     * @return array
     */

    public function findAllNoUser() : array
    {
        $qb1 = $this->createQueryBuilder('r')
            ->select('r.id,r.name')
            ->where('r.available is null ')

            ->getQuery();

        return $qb1->execute();


    }
}
