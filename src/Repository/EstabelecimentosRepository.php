<?php

namespace App\Repository;

use App\Entity\Estabelecimentos;
use App\Exception\EstabelecimentosNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estabelecimentos>
 */
class EstabelecimentosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estabelecimentos::class);
    }

    public function save(Estabelecimentos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Estabelecimentos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of findOrFail
     * @param int $id
     * @throws \App\Exception\EstabelecimentosNotFoundException
     * @return object
     */
    public function findOrFail(int $id): Estabelecimentos
    {
        $estabelecimentos = $this->find($id);

        if(!$estabelecimentos) {
            throw new EstabelecimentosNotFoundException();
        }

        return $estabelecimentos;
    }

    //    /**
    //     * @return Estabelecimento[] Returns an array of Estabelecimento objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Estabelecimento
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
