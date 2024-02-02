<?php

namespace App\Repository;

use App\Entity\CliTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliTemplate>
 *
 * @method CliTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliTemplate[]    findAll()
 * @method CliTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliTemplate::class);
    }

//    /**
//     * @return CliTemplate[] Returns an array of CliTemplate objects
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

//    public function findOneBySomeField($value): ?CliTemplate
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertTemplate($id,$tipocli,$template,$activo,$listProcesos,$familia)
    {
        $enttemp = $this->findOneByNombtemplate($template);
        if($id != 0)
            {
                $enttemp = $this->findOneById($id);
                $enttemp->setNombtemplate($template)
                        ->setClitipo($tipocli)
                        ->setGrupo($familia)
                        ->setInactivo($activo);
            }
            elseif($enttemp)
            {
                $enttemp->setNombtemplate($template)
                        ->setClitipo($tipocli)
                        ->setGrupo($familia)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $enttemp = new CliTemplate;
                $enttemp->setNombtemplate($template)
                        ->setClitipo($tipocli)
                        ->setGrupo($familia)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }

            foreach($listProcesos as $protemp)
            {
                $procesotemp = $protemp['proceso'];
                $activo      = $protemp['activo'];
                $enttemp->removeProceso($procesotemp);
                if($activo)
                {
                    $enttemp->addProceso($procesotemp);
                }
            }
        return $enttemp;
    }
}
