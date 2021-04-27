<?php

namespace App\Repository;

use App\Entity\Saucisson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Saucisson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Saucisson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Saucisson[]    findAll()
 * @method Saucisson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaucissonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Saucisson::class);
    }

    // /**
    //  * @return Saucisson[] Returns an array of Saucisson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Saucisson
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
