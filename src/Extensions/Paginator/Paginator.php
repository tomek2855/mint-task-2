<?php


namespace App\Extensions\Paginator;


use Doctrine\ORM\QueryBuilder;

interface Paginator
{
    function paginate(QueryBuilder $query): Paginator;

    function setPage(int $page): void;

    function setAllRecordsCount(int $count): void;

    function getPage(): int;

    function getAllPagesCount(): int;

    function getQueryBuilder(): QueryBuilder;
}