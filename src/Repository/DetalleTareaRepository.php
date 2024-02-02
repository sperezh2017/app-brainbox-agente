<?php

namespace App\Repository;

use App\Entity\DetalleTarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetalleTarea>
 *
 * @method DetalleTarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleTarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleTarea[]    findAll()
 * @method DetalleTarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleTareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetalleTarea::class);
    }

//    /**
//     * @return DetalleTarea[] Returns an array of DetalleTarea objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetalleTarea
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
