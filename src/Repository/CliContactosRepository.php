<?php

namespace App\Repository;

use App\Entity\CliContactos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliContactos>
 *
 * @method CliContactos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliContactos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliContactos[]    findAll()
 * @method CliContactos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliContactosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliContactos::class);
    }

//    /**
//     * @return CliContactos[] Returns an array of CliContactos objects
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

//    public function findOneBySomeField($value): ?CliContactos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertContacto($pnombre,$snombre,$papellido,$sapellido,$contrasena,$activo,$cliente,$contacto,$cargo,$correo,$nuevo,$celular)
    {
        if(empty($contacto))
        {
          $contacto = $this->findOneByEmail($correo);
        }
        if($nuevo == 0 and $contacto)
              {
                $contacto->sePrnombre($pnombre)
                        ->setSegnombre($snombre)
                        ->setPrapellido($papellido)
                        ->setSegapellido($sapellido)
                        ->setEmail($correo)
                        ->setCelular($celular)
                        ->setClave($contrasena)
                        ->setCliente($cliente)
                        ->setCargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(0);
                //$grabar = 1;
              }
              elseif($nuevo == 1 and empty($contacto))
              {
                $contacto = new CliContactos();
                $contacto->sePrnombre($pnombre)
                        ->setSegnombre($snombre)
                        ->setPrapellido($papellido)
                        ->setSegapellido($sapellido)
                        ->setEmail($correo)
                        ->setCelular($celular)
                        ->setClave($contrasena)
                        ->setCliente($cliente)
                        ->setCargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(0);
                //$grabar = 1;
              }
              elseif($nuevo == 1 and $contacto)
              {
                $contacto->sePrnombre($pnombre)
                        ->setSegnombre($snombre)
                        ->setPrapellido($papellido)
                        ->setSegapellido($sapellido)
                        ->setEmail($correo)
                        ->setCelular($celular)
                        ->setClave($contrasena)
                        ->setCliente($cliente)
                        ->setCargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(0);
                //$grabar = 1;
              }
            
           return $contacto;
    }
}
