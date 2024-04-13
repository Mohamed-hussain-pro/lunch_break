<?php

namespace App\Repository;

use App\Entity\Resturant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resturant>
 *
 * @method Resturant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resturant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resturant[]    findAll()
 * @method Resturant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResturantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resturant::class);
    }

         /**
         * @return Resturant[]
         */
        public function findByResturantIds(array $ids): array
        {
            return $this->createQueryBuilder('r')
                ->andWhere('r.id IN (:ids)')
                ->setParameter('ids', $ids)
                ->orderBy('r.id', 'ASC')
                ->setMaxResults(6)
                ->getQuery()
                ->getResult();
        }

    //    /**
    //     * @return Resturant[] Returns an array of Resturant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Resturant
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
