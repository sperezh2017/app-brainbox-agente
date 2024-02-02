<?php

namespace App\Repository;

use App\Entity\CatGrupo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatGrupo>
 *
 * @method CatGrupo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatGrupo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatGrupo[]    findAll()
 * @method CatGrupo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatGrupoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatGrupo::class);
    }

//    /**
//     * @return CatGrupo[] Returns an array of CatGrupo objects
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

//    public function findOneBySomeField($value): ?CatGrupo
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertGrupo($id,$guia,$grupo,$activo,$excluye)
    {
        $entgrupo = $this->findOneByGrudescripcion($grupo);
        if($id != 0)
            {
                $entgrupo = $this->findOneById($id);
                $entgrupo->setGrudescripcion($grupo)
                         ->setTipoguia($guia)
                         ->setInactivo($activo)
                         ->setExcluyente($excluye);
            }
            elseif($entgrupo)
            {
                $entgrupo->setGrudescripcion($grupo)
                         ->setTipoguia($guia)   
                         ->setInactivo($activo)
                         ->setExcluyente($excluye)
                         ->setEliminar(false);
            }
            else
            {
                $entgrupo = new CatGrupo;
                $entgrupo->setGrudescripcion($grupo)
                         ->setTipoguia($guia)
                         ->setInactivo($activo)
                         ->setExcluyente($excluye)
                         ->setEliminar(0);
            }
        return $entgrupo;
    }
}
