<?php

namespace App\Repository;

use App\Entity\SubCategorias;
use App\Exception\SubCategoriasNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubCategorias>
 */
class SubCategoriasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubCategorias::class);
    }

    public function save(SubCategorias $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of remove
     * @param \App\Entity\SubCategorias $entity
     * @param bool $flush
     * @return void
     */
    public function remove(SubCategorias $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOrFail(int $id): SubCategorias
    {
        $subCategoria = $this->find($id);

        if(!$subCategoria) {
            throw new SubCategoriasNotFoundException();
        }

        return $subCategoria;
    }

    //    /**
    //     * @return SubCategorias[] Returns an array of SubCategorias objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SubCategorias
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
