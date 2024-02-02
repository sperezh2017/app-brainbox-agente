<?php

namespace App\Repository;

use App\Entity\VariableInicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VariableInicio>
 *
 * @method VariableInicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariableInicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariableInicio[]    findAll()
 * @method VariableInicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariableInicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariableInicio::class);
    }

//    /**
//     * @return VariableInicio[] Returns an array of VariableInicio objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VariableInicio
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
