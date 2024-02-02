<?php

namespace App\Repository;

use App\Entity\CliVariable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliVariable>
 *
 * @method CliVariable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliVariable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliVariable[]    findAll()
 * @method CliVariable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliVariableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliVariable::class);
    }

//    /**
//     * @return CliVariable[] Returns an array of CliVariable objects
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

//    public function findOneBySomeField($value): ?CliVariable
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
