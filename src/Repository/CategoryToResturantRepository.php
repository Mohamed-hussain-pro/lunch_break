<?php

namespace App\Repository;

use App\Entity\CategoryToResturant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryToResturant>
 *
 * @method CategoryToResturant|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryToResturant|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryToResturant[]    findAll()
 * @method CategoryToResturant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryToResturantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryToResturant::class);
    }

    //    /**
    //     * @return CategoryToResturant[] Returns an array of CategoryToResturant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CategoryToResturant
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
