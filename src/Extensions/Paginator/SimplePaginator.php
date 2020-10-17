<?php


namespace App\Extensions\Paginator;


use Doctrine\ORM\QueryBuilder;

class SimplePaginator implements Paginator
{
    const PER_PAGE = 10;

    private $perPage;

    private $page;

    private $allRecordsCount;

    private $queryBuilder;

    public function __construct(int $perPage = self::PER_PAGE, int $page = 1)
    {
        $this->perPage = $perPage;
        $this->page = $page;
    }

    /**
     * @param QueryBuilder $query
     * @return $this|Paginator
     */
    public function paginate(QueryBuilder $query): Paginator
    {
        $this->queryBuilder = $query;

        $this->getQueryBuilder()
            ->setFirstResult((self::PER_PAGE * $this->page) - $this->perPage)
            ->setMaxResults(self::PER_PAGE);

        return $this;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    /**
     * @param int $page
     */
    function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @param int $count
     */
    public function setAllRecordsCount(int $count): void
    {
        $this->allRecordsCount = $count;
    }

    /**
     * @return int
     */
    function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    function getAllPagesCount(): int
    {
        return (int)ceil($this->allRecordsCount / self::PER_PAGE);
    }
}