<?php

declare(strict_types=1);

namespace App\Content\Domain\Model;

use App\Common\Domain\Aggregate\AggregateRoot;
use App\Common\Domain\Model\ModelReference;
use App\Content\Comment\Domain\Model\Comment;
use App\Content\Domain\Event\ContentCreatedEventFactory;

/**
 * Content can be any type of content. Blog, Comments for now. Maybe reviews, videos or memes in the future.
 * Children are intended to always be comments only.
 * 
 * This class is using a single table inheritance to allow different content types to have a different
 * set of attributes, while also sharing common attributes to follow SOLID principles.
 */
abstract class Content extends AggregateRoot
{
    public const TYPE_BLOG = 'blog'; // @TODO enum
    public const TYPE_COMMENT = 'comment';

    public function __construct(
        protected ?int $id,
        protected ?string $title,
        protected string $description,
        protected ?\DateTime $createdAt,
        protected ModelReference $author,
        protected ?Content $parent,
        protected ?iterable $children = [],
    ) {
        $this->createdAt = $createdAt ?? new \DateTime();
    }

    public static function create(
        ?int $id,
        ?string $title,
        string $description,
        ModelReference $author,
        ?Content $parent = null,
    ): self {
        $content = new static($id, $title, $description, new \DateTime(), $author, $parent);
        $content->record(ContentCreatedEventFactory::createEvent($content));

        return $content;
    }

    abstract public function getType(): string;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getAuthor(): ModelReference
    {
        return $this->author;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function getChildren(): iterable
    {
        return $this->children ?? [];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'class' => get_class($this), // @TODO possible problem with Doctrine's Proxy classes
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'createdAt' => $this->getCreatedAt()->format('c'),
            'author' => $this->getAuthor()->toArray(),
            'parent' => $this->getParent()?->toArray(),
            'children' => array_map(function (Comment $comment) {
                return $comment->toArray();
            }, (array) $this->getChildren()),
        ];
    }

    public static function fromArray(array $parameters): self
    {
        return new $parameters['class'](
            $parameters['id'],
            $parameters['title'],
            $parameters['description'],
            new \DateTime($parameters['createdAt']),
            ModelReference::fromArray($parameters['author']),
            $parameters['parent'] ? $parameters['parent']['class']::fromArray($parameters['parent']) : null,
            $parameters['children'] ? array_map(function (array $rawComment) {
                return Comment::fromArray($rawComment);
            }, $parameters['children']) : []
        );
    }
}
