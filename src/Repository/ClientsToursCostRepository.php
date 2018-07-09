<?php

namespace App\Repository;

use App\Entity\ClientTourCost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClientTourCost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientTourCost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientTourCost[]    findAll()
 * @method ClientTourCost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientsToursCostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClientTourCost::class);
    }

//    /**
//     * @return ClientTourCost[] Returns an array of ClientTourCost objects
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
    public function findOneBySomeField($value): ?ClientTourCost
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
