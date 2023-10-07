<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Content\Blog\Domain\Model\Blog;
use App\Content\Blog\Domain\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineBlogRepository extends DoctrineRepository implements BlogRepository
{
    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        parent::__construct($managerRegistry, $entityManager, Blog::class);
    }

    public function get(int $id): ?Blog
    {
        return $this->find($id);
    }

    public function save(Blog $blog): void
    {
        $this->persist($blog);
    }
}
