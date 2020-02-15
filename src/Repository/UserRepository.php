<?php

namespace App\Repository;

use App\Entity\Contest;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, User::class);
        $this->entityManager = $entityManager;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     * @param UserInterface $user
     * @param string $newEncodedPassword
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @param int $page
     * @param array $filters
     * @return Paginator|User[]
     */
    public function pagination(int $page = 1, ?array $filters = null): Paginator {
        $dql = $this->createQueryBuilder('user');

        if(!empty($filters['search'])) {
            $or = $dql->expr()->orX();

            $or->add('user.firstname LIKE :search');
            $or->add('user.lastname LIKE :search');
            $or->add('user.email LIKE :search');

            $dql->andWhere($or);

            $dql->setParameter('search', '%'.mb_strtolower($filters['search']).'%');
        }

        $dql->orderBy('user.lastname', 'ASC');
        $dql->addOrderBy('user.firstname', 'ASC');

        $query = $dql->getQuery();
        $query->setMaxResults(10);
        $query->setFirstResult(($page - 1) * 10);

        return new Paginator($query);
    }
}
