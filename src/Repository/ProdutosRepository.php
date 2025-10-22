<?php

namespace App\Repository;

use App\Entity\Produtos;
use App\Exception\ProdutosNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produtos>
 */
class ProdutosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produtos::class);
    }

    /**
     * Summary of save
     * @param \App\Entity\Produtos $entity
     * @param bool $flush
     * @return void
     */
    public function save(Produtos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of remove
     * @param \App\Entity\Produtos $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Produtos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of findOrFail
     * @param int $id
     * @throws \App\Exception\ProdutosNotFoundException
     * @return Produtos
     */
    public function findOrFail(int $id): Produtos
    {
        $produto = $this->find($id);

        if(!$produto) {
            throw new ProdutosNotFoundException();
        }

        return $produto;
    }

    //    /**
    //     * @return Produto[] Returns an array of Produtos objects
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

    //    public function findOneBySomeField($value): ?Produto
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
