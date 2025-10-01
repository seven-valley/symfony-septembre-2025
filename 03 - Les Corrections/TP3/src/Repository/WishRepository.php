<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wish>
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    //    /**
    //     * @return Wish[] Returns an array of Wish objects
    //     */
   //    public function findBy($value): array
    //    {
    //     return $this->createQueryBuilder('i')
    //     ->where('i.isPublished = true')
    //     ->orderBy('i.createdAT', 'DESC')
    //     ->setMaxResults(50)
    //     ->getQuery()
    //     ->getResult()
    // ;
    //   }

    //    public function findOneBySomeField($value): ?Wish
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
