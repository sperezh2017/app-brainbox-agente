<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cliente>
 *
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

//    /**
//     * @return Cliente[] Returns an array of Cliente objects
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

//    public function findOneBySomeField($value): ?Cliente
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

  public function insertCliente($nuevo,$cliente,$razon,$correocli,$telefono,$agente,$tipodocid,$documento,$ciudad,$direcc,$activo,$template,$regimen,$fechaini,$tipocli)
    {
        if(empty($cliente))
        {
          $cliente = $this->findOneByDocumento($documento);
        }
        if($nuevo == 0 and $cliente)
              {
                $cliente->setRazonsocial($razon)
                        ->setEmail($correocli)
                        ->setTelefono($telefono)
                        ->setAgente($agente)
                        ->setTipdoc($tipodocid)
                        ->setDocumento($documento)
                        ->setCiudad($ciudad)
                        ->setDireccion($direcc)
                        ->setInactivo($activo)
                        ->setEliminar(0)
                        ->setTemplate($template)
                        ->setRegimen($regimen)
                        ->setDateIn($fechaini)
                        ->setCliTipo($tipocli);
                //$grabar = 1;
              }
              elseif($nuevo == 1 and empty($cliente))
              {
                $cliente = new Cliente();
                $cliente->setRazonsocial($razon)
                        ->setEmail($correocli)
                        ->setTelefono($telefono)
                        ->setAgente($agente)
                        ->setTipdoc($tipodocid)
                        ->setDocumento($documento)
                        ->setCiudad($ciudad)
                        ->setDireccion($direcc)
                        ->setInactivo($activo)
                        ->setEliminar(0)
                        ->setTemplate($template)
                        ->setRegimen($regimen)
                        ->setDateIn($fechaini)
                        ->setCliTipo($tipocli);
                //$grabar = 1;
              }
              elseif($nuevo == 1 and $cliente)
              {
                $cliente->setRazonsocial($razon)
                        ->setEmail($correocli)
                        ->setTelefono($telefono)
                        ->setAgente($agente)
                        ->setTipdoc($tipodocid)
                        ->setDocumento($documento)
                        ->setCiudad($ciudad)
                        ->setDireccion($direcc)
                        ->setInactivo($activo)
                        ->setEliminar(false)
                        ->setTemplate($template)
                        ->setRegimen($regimen)
                        ->setDateIn($fechaini)
                        ->setCliTipo($tipocli);
                //$grabar = 1;
              }
            
           return $cliente;
    }
}
