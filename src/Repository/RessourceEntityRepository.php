<?php

namespace App\Repository;

use App\Entity\RessourceEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RessourceEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method RessourceEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method RessourceEntity[]    findAll()
 * @method RessourceEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessourceEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RessourceEntity::class);
    }

    /**
     * @param $userId int : User Id
     * @param $elements int : Number of elment to fetch,
     * @return void
     */

    public function findLastActionFromUser(int $userId, int $elements){
            $qb = $this->createQueryBuilder('r')
                ->select('r.id, r.coeff_pepite ,r.price, r.date, i.name')
                ->where('r.user_id = :id')
                ->leftJoin('r.ressource_id','i')
                ->setParameter('id',$userId)
                ->orderBy('r.date','desc')
                ->setMaxResults($elements)
                ->getQuery();

            return $qb->execute();


    }


    // Get last updated element of RessourceEntity
    public function getLastestElement($id,$userid){

        $qb1 = $this->createQueryBuilder('r')
            ->leftJoin('r.ressource_id','c')
            ->where('r.user_id = :userid')
            ->andWhere('r.ressource_id = :id')
            ->setParameter('userid',$userid)
            ->setParameter('id',$id)
            ->orderBy('r.date', 'asc')
            ->setMaxResults(1)
            ->getQuery();
        return $qb1->execute();


    }

    // /**
    //  * @return RessourceEntity[] Returns an array of RessourceEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RessourceEntity
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
