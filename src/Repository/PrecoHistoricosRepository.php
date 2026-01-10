<?php

namespace App\Repository;

use App\Entity\PrecoHistoricos;
use App\Exception\PrecoHistoricosNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrecoHistoricos>
 */
class PrecoHistoricosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrecoHistoricos::class);
    }

    /**
     * Summary of save
     * @param PrecoHistoricos $entity
     * @param bool $flush
     * @return void
     */
    public function save(PrecoHistoricos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of remove
     * @param PrecoHistoricos $entity
     * @param bool $flush
     * @return void
     */
    public function remove(PrecoHistoricos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of findOrFail
     * @param int $id
     * @throws PrecoHistoricosNotFoundException
     * @return object
     */
    public function findOrFail(int $id): PrecoHistoricos
    {
        $precoHistorico = $this->find($id);

        if(!$precoHistorico) {
            throw new PrecoHistoricosNotFoundException();
        }

        return $precoHistorico;
    }

    //    /**
    //     * @return PrecoHistoricos[] Returns an array of PrecoHistoricos objects
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

    //    public function findOneBySomeField($value): ?PrecoHistoricos
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
