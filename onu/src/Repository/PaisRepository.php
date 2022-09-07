<?php

namespace App\Repository;

use App\Entity\Pais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pais>
 *
 * @method Pais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pais[]    findAll()
 * @method Pais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pais::class);
    }

    public function add(Pais $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pais $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
  
   /**
    * @return Pais[] retorna todos los paises ordenados alfabeticamente
    */
   public function findAll(): array
   {
        
       return $this->createQueryBuilder('pais')
           ->orderBy('pais.nombre', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   /**
    * @return Pais[] retorna un array con los paises que concuerdan con el nombre
    */
   public function filtrarNombre($nombre): array
   {
       return $this->createQueryBuilder('pais')
           ->andWhere('lower(pais.nombre) like lower(:nombre)')
           ->setParameter('nombre', '%'.$nombre.'%')
           ->getQuery()
           ->getArrayResult()
       ;
   }

   public function getDetallePais($id)
   {
        $pais=$this->createQueryBuilder('p')
        ->andWhere('p.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getArrayResult();
        return $pais[0];
   }


   /**
    * @return Pais[] retorna un array de paises que pertenecen a la region
    */
   public function filtrarPaisesPorRegion(int $codigoRegion): array
   {
       $entityManager = $this->getEntityManager();

       $query = $entityManager->createQuery(
           'SELECT p
            FROM App\Entity\Pais p
            JOIN p.region r
            WHERE r.codigo=:codigoRegion')
            ->setParameter('codigoRegion',$codigoRegion);

       return $query->getArrayResult();
   }
}
