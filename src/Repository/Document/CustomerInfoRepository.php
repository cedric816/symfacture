<?php

namespace App\Repository\Document;

use App\Entity\Document\CustomerInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CustomerInfo>
 *
 * @method CustomerInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerInfo[]    findAll()
 * @method CustomerInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerInfo::class);
    }

    //    /**
    //     * @return CustomerInfo[] Returns an array of CustomerInfo objects
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

    //    public function findOneBySomeField($value): ?CustomerInfo
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
