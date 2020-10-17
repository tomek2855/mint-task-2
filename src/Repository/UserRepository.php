<?php

namespace App\Repository;

use App\Entity\User;
use App\Extensions\Paginator\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Get paginated results
     * @param Paginator $paginator
     * @return int|mixed|string
     */
    public function findAllPaginated(Paginator $paginator)
    {
        $query = $this->createQueryBuilder('u')
            ->orderBy('u.username', 'ASC');

        $paginator->setAllRecordsCount($this->count([]));

        return $paginator->paginate($query)
            ->getQueryBuilder()
            ->getQuery()
            ->getResult();
    }
}
