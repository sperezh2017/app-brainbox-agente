<?php

namespace App\Repository;

use App\Entity\CatDias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatDias>
 *
 * @method CatDias|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatDias|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatDias[]    findAll()
 * @method CatDias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatDiasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatDias::class);
    }

//    /**
//     * @return CatDias[] Returns an array of CatDias objects
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

//    public function findOneBySomeField($value): ?CatDias
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
