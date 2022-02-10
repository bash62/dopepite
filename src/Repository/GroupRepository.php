<?php

namespace App\Repository;

use App\Entity\Group;
use App\Entity\User;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    public function findAllCommonUserIds($userId){
        $qb = $this->createQueryBuilder('g')

            ->select( 'g')
            ->from(Users::class,'u')
            ->innerJoin('g.users','i',)
            ->where('i.id = :userId')
            ->setParameter('userId',$userId)
            ->getQuery();

        return $qb->getResult();
    }

}
