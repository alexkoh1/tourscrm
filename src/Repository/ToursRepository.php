<?php

namespace App\Repository;

use App\Entity\Tour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tour::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['id' => 'DESC']);
    }
}
