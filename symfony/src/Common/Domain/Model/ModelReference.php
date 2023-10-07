<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Model;

# This is used to reference models from a different domain
# without creating an unneccesary dependency
interface ModelReference
{
    public function getId(): ?int;

    #[ArrayShape(['id' => 'int', 'class' => 'string'])]
    public function toArray(): array;

    public static function fromArray(#[ArrayShape(['id' => 'int', 'class' => 'string'])] array $parameters): self;
}
