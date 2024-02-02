<?php

namespace App\Repository;

use App\Entity\CliVariableTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliVariableTemplate>
 *
 * @method CliVariableTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliVariableTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliVariableTemplate[]    findAll()
 * @method CliVariableTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliVariableTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliVariableTemplate::class);
    }

//    /**
//     * @return CliVariableTemplate[] Returns an array of CliVariableTemplate objects
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

//    public function findOneBySomeField($value): ?CliVariableTemplate
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function insertCliVariable($cliente,$variable,$visible)
  {
    $clientevariable = new CliVariableTemplate();
        $clientevariable->setCliente($cliente) 
                        ->setVariable($variable)
                        ->setVisible($visible);
          
        
       return $clientevariable;
  }
}
