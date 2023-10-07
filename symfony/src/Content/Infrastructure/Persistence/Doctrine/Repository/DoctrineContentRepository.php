<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Domain\Model\PagedList;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Content\Domain\Model\Content;
use App\Content\Domain\Model\ContentSearch;
use App\Content\Domain\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineContentRepository extends DoctrineRepository implements ContentRepository
{
    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        parent::__construct($managerRegistry, $entityManager, Content::class);
    }

    # this method is ment to implement proper searching and ordering
    # at the moment it is only covering the basic use case - fetching a paginated list of content from the database
    public function search(ContentSearch $contentSearch): PagedList
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');

        // only select IDs so we do not have to work with hydration the hard way
        $ids = $this
            ->getEntityManager()
            ->createNativeQuery(
                'SELECT c.id FROM content AS c WHERE c.type IN (:types) ORDER BY c.id desc LIMIT :limit OFFSET :offset',
                $rsm
            )
            ->setParameters([
                'types' => $contentSearch->getTypes(),
                'limit' => $contentSearch->getLimit(),
                'offset' => $contentSearch->getOffset(),
            ])
            ->getScalarResult();

        // @TODO replace findBy with a custom query/queries to remove n+1 in view
        return new PagedList(
            $this->findBy(['id' => array_column($ids, 'id')]),
            $this->count([]),
        );
    }
}
