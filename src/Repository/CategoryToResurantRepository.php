<?php

namespace App\Repository;

use App\Entity\CategoryToResurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryToResurant>
 *
 * @method CategoryToResurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryToResurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryToResurant[]    findAll()
 * @method CategoryToResurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryToResurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryToResurant::class);
    }

    //    /**
    //     * @return CategoryToResurant[] Returns an array of CategoryToResurant objects
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

    //    public function findOneBySomeField($value): ?CategoryToResurant
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
