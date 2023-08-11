<?php

namespace App\Repository;

use App\Entity\TypeWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeWallet>
 *
 * @method TypeWallet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeWallet|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeWallet[]    findAll()
 * @method TypeWallet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeWalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeWallet::class);
    }

//    /**
//     * @return TypeWallet[] Returns an array of TypeWallet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeWallet
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
