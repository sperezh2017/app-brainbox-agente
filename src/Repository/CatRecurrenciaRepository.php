<?php

namespace App\Repository;

use App\Entity\CatRecurrencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatRecurrencia>
 *
 * @method CatRecurrencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatRecurrencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatRecurrencia[]    findAll()
 * @method CatRecurrencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatRecurrenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatRecurrencia::class);
    }

//    /**
//     * @return CatRecurrencia[] Returns an array of CatRecurrencia objects
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

//    public function findOneBySomeField($value): ?CatRecurrencia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertRecurrencia($id,$recurrencia,$activo)
    {
        $entrecurrencia = $this->findOneByDescripcion($recurrencia);
        if($id != 0)
            {
                $entrecurrencia = $this->findOneById($id);
                $entrecurrencia->setDescripcion($recurrencia)
                               ->setInactivo($activo);
            }
            elseif($entrecurrencia)
            {
                $entrecurrencia->setDescripcion($recurrencia)
                               ->setInactivo($activo)
                               ->setEliminar(0);
            }
            else
            {
                $entrecurrencia = new CatRecurrencia;
                $entrecurrencia->setDescripcion($recurrencia)
                               ->setInactivo($activo)
                               ->setEliminar(0);
            }
        
        return $entrecurrencia;
    }
}
