<?php

namespace App\Repository;

use App\Entity\CatMes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatMes>
 *
 * @method CatMes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatMes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatMes[]    findAll()
 * @method CatMes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatMesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatMes::class);
    }

//    /**
//     * @return CatMes[] Returns an array of CatMes objects
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

//    public function findOneBySomeField($value): ?CatMes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
