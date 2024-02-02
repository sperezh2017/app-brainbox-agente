<?php

namespace App\Repository;

use App\Entity\CatEntidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatEntidad>
 *
 * @method CatEntidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatEntidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatEntidad[]    findAll()
 * @method CatEntidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatEntidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatEntidad::class);
    }

//    /**
//     * @return CatEntidad[] Returns an array of CatEntidad objects
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

//    public function findOneBySomeField($value): ?CatEntidad
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertEntidad($id,$codigo,$entidad,$activo)
    {
        $ententidad = $this->findOneByCodigo($codigo);
        if($id != 0)
            {
                $ententida = $this->findOneById($id);
                $ententida->setCodigo($codigo)
                           ->setDescripcion($entidad)
                           ->setInactivo($activo);
            }
            elseif($ententidad)
            {
                $ententidad->setCodigo($codigo)
                           ->setDescripcion($entidad)
                           ->setInactivo($activo)
                           ->setEliminar(0);
            }
            else
            {
                $ententidad = new CatEntidad;
                $ententidad->setCodigo($codigo)
                           ->setDescripcion($entidad)
                           ->setInactivo($activo)
                           ->setEliminar(0);
            }
        return $ententidad;
    }
}
