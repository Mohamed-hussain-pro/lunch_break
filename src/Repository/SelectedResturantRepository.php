<?php

namespace App\Repository;

use App\Entity\SelectedResturant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SelectedResturant>
 *
 * @method SelectedResturant|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectedResturant|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectedResturant[]    findAll()
 * @method SelectedResturant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectedResturantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectedResturant::class);
    }

    //    /**
    //     * @return SelectedResturant[] Returns an array of SelectedResturant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SelectedResturant
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
