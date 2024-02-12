<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Partner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partner[]    findAll()
 * @method Partner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
    }

    /**
     * @param int $page
     * @param array $filters
     * @return Paginator|Partner[]
     */
    public function pagination(int $page = 1, ?array $filters = null): Paginator {
        $dql = $this->createQueryBuilder('partner');

        $dql->join('partner.year', 'year');

        if(!empty($filters['year'])) {
            $dql->andWhere('partner.year = :year');
            $dql->setParameter('year', $filters['year']);
        }

        $dql->orderBy('partner.id', 'DESC');

        $query = $dql->getQuery();
        $query->setMaxResults(10);
        $query->setFirstResult(($page - 1) * 10);

        return new Paginator($query);
    }
}
