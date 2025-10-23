<?php

namespace App\Repository;

use App\Entity\VariacaoProdutos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VariacaoProdutos>
 */
class VariacaoProdutosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariacaoProdutos::class);
    }

    /**
     * Summary of save
     * @param \App\Entity\VariacaoProdutos $entity
     * @param bool $flush
     * @return void
     */
    public function save(VariacaoProdutos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VariacaoProdutos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return VariacaoProdutos[] Returns an array of VariacaoProdutos objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?VariacaoProdutos
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
