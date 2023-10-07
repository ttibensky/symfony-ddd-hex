<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Persistence\Doctrine\Repository;

use App\Content\Blog\Domain\Model\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }
}
