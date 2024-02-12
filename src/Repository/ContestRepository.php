<?php

namespace App\Repository;

use App\Entity\Contest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Contest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contest[]    findAll()
 * @method Contest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contest::class);
    }

    /**
     * @param int $page
     * @param array $filters
     * @return Paginator|Contest[]
     */
    public function pagination(int $page = 1, ?array $filters = null): Paginator {
        $dql = $this->createQueryBuilder('contest');

        $dql->join('contest.year', 'year');

        if(!empty($filters['year'])) {
            $dql->andWhere('contest.year = :year');
            $dql->setParameter('year', $filters['year']);
        }

        $dql->orderBy('year.id', 'DESC');

        $query = $dql->getQuery();
        $query->setMaxResults(10);
        $query->setFirstResult(($page - 1) * 10);

        return new Paginator($query);
    }
}
