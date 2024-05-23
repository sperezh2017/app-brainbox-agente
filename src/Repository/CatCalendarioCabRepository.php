<?php

namespace App\Repository;

use App\Entity\CatCalendarioCab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatCalendarioCab>
 *
 * @method CatCalendarioCab|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatCalendarioCab|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatCalendarioCab[]    findAll()
 * @method CatCalendarioCab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatCalendarioCabRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatCalendarioCab::class);
    }

    //    /**
    //     * @return CatCalendarioCab[] Returns an array of CatCalendarioCab objects
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

    //    public function findOneBySomeField($value): ?CatCalendarioCab
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function insertCatCalendario($id,$categoria,$frecuencia,$activo)
    {
        $catCalendario = $this->findOneByDescripcion($categoria);
        if($id != 0)
            {
                $catCalendario = $this->findOneById($id);
                $catCalendario->setDescripcion($categoria)
                            ->setRecurrencia($frecuencia)
                            ->setInactivo($activo);
            }
            elseif($catCalendario)
            {
                $catCalendario->setDescripcion($categoria)
                            ->setRecurrencia($frecuencia)
                            ->setInactivo($activo)
                            ->setEliminar(false);
            }
            else
            {
                $catCalendario = new CatCalendarioCab;
                $catCalendario->setDescripcion($categoria)
                            ->setRecurrencia($frecuencia)
                            ->setInactivo($activo)
                            ->setEliminar(false);
            }
        return $catCalendario;
    }
}
