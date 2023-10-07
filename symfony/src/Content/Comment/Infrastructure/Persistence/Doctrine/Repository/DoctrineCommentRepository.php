<?php

declare(strict_types=1);

namespace App\Content\Comment\Infrastructure\Persistence\Doctrine\Repository;

use App\Content\Comment\Domain\Model\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
}
