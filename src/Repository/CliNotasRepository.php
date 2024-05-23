<?php

namespace App\Repository;

use App\Entity\CliNotas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliNotas>
 *
 * @method CliNotas|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliNotas|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliNotas[]    findAll()
 * @method CliNotas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliNotasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliNotas::class);
    }

//    /**
//     * @return CliNotas[] Returns an array of CliNotas objects
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

//    public function findOneBySomeField($value): ?CliNotas
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function insertActividad($actividad,$cliente,$usuario,$fecha)
    {
        
                $nActividad = new CliNotas();
                $nActividad->setNota($actividad)
                            ->setCliente($cliente)
                            ->setUsuCreate($usuario)
                            ->setFechaCreate($fecha)
                            ->setUsuUpdate($usuario)
                            ->setFechaUpdate($fecha);
              
            
           return $nActividad;
    }
}
