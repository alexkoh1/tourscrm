<?php

namespace App\Repository;

use App\Entity\ClientsToursCost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClientsToursCost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientsToursCost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientsToursCost[]    findAll()
 * @method ClientsToursCost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientsToursCostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClientsToursCost::class);
    }

//    /**
//     * @return ClientsToursCost[] Returns an array of ClientsToursCost objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientsToursCost
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
