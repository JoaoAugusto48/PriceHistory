<?php

namespace App\Repository;

use App\Entity\Marcas;
use App\Exception\MarcasNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Marcas>
 *
 * @method Marcas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marcas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marcas[]    findAll()
 * @method Marcas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarcasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marcas::class);
    }

    public function save(Marcas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Marcas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Summary of findOrFail
     * @param int $id
     * @throws \App\Exception\MarcasNotFoundException
     * @return Marcas
     */
    public function findOrFail(int $id): Marcas
    {
        $marca = $this->find($id);

        if(!$marca) {
            throw new MarcasNotFoundException();
        }

        return $marca;
    }

    //    /**
    //     * @return Marcas[] Returns an array of Marcas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Marcas
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
