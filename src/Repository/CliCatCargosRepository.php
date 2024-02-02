<?php

namespace App\Repository;

use App\Entity\CliCatCargos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliCatCargos>
 *
 * @method CliCatCargos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliCatCargos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliCatCargos[]    findAll()
 * @method CliCatCargos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliCatCargosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliCatCargos::class);
    }

//    /**
//     * @return CliCatCargos[] Returns an array of CliCatCargos objects
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

//    public function findOneBySomeField($value): ?CliCatCargos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertCargoContacto($id,$cargo,$activo)
    {
        $entcargo = $this->findOneByClicargo($cargo);
        if($id != 0)
            {
                $entcargo = $this->findOneById($id);
                $entcargo->setClicargo($cargo)
                        ->setInactivo($activo);
            }
            elseif($entcargo)
            {
                $entcargo->setClicargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $entcargo = new CliCatCargos;
                $entcargo->setClicargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
        return $entcargo;
    }
}
