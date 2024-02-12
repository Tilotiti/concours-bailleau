<?php

namespace App\Repository;

use App\Entity\Contest;
use App\Entity\Thank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

    /**
     * @param int $page
     * @param array $filters
     * @return Paginator|Thank[]
     */
    public function pagination(int $page = 1, ?array $filters = null): Paginator {
        $dql = $this->createQueryBuilder('thank');

        $dql->join('thank.year', 'year');

        if(!empty($filters['year'])) {
            $dql->andWhere('thank.year = :year');
            $dql->setParameter('year', $filters['year']);
        }

        $dql->orderBy('year.id', 'DESC');

        $query = $dql->getQuery();
        $query->setMaxResults(10);
        $query->setFirstResult(($page - 1) * 10);

        return new Paginator($query);
    }
}
