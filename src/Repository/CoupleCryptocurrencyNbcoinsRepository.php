<?php

namespace App\Repository;

use App\Entity\CoupleCryptocurrencyNbcoins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoupleCryptocurrencyNbcoins>
 *
 * @method CoupleCryptocurrencyNbcoins|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoupleCryptocurrencyNbcoins|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoupleCryptocurrencyNbcoins[]    findAll()
 * @method CoupleCryptocurrencyNbcoins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoupleCryptocurrencyNbcoinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoupleCryptocurrencyNbcoins::class);
    }

    //    /**
    //     * @return CoupleCryptocurrencyNbcoins[] Returns an array of CoupleCryptocurrencyNbcoins objects
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

    //    public function findOneBySomeField($value): ?CoupleCryptocurrencyNbcoins
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
