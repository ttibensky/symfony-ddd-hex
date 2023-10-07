<?php

declare(strict_types=1);

namespace App\Content\Comment\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Content\Comment\Domain\Model\Comment;
use App\Content\Comment\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCommentRepository extends DoctrineRepository implements CommentRepository
{
    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        parent::__construct($managerRegistry, $entityManager, Comment::class);
    }

    public function save(Comment $comment): void
    {
        $this->persist($comment);
    }
}
