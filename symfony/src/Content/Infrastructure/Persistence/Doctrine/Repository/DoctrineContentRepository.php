<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Domain\Model\PagedList;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Content\Domain\Model\Content;
use App\Content\Domain\Model\ContentSearch;
use App\Content\Domain\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineContentRepository extends DoctrineRepository implements ContentRepository
{
    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        parent::__construct($managerRegistry, $entityManager, Content::class);
    }

    # this method is ment to implement proper searching and ordering
    # at the moment it is only covering the basic use case - fetching a paginated list of content from the database
    public function search(ContentSearch $cs): PagedList
    {
        // @TODO rewrite to custom query, joins authors and first level of comments
        return new PagedList(
            $this->findBy([], ['id' => 'desc'], $cs->getLimit(), $cs->getOffset()),
            $this->count([]),
        );
    }
}
