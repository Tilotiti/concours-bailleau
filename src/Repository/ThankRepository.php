<?php

namespace App\Repository;

use App\Entity\Thank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Thank|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thank|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thank[]    findAll()
 * @method Thank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thank::class);
    }
}
