<?php

namespace App\Repository;

use App\Entity\Monkey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Monkey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monkey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monkey[]    findAll()
 * @method Monkey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonkeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monkey::class);
    }

    // /**
    //  * @return Monkey[] Returns an array of Monkey objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Monkey
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
