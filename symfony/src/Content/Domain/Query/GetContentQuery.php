<?php

declare(strict_types=1);

namespace App\Content\Domain\Query;

use App\Common\Domain\Bus\Query\Query;

final class GetContentQuery implements Query
{
    public function __construct(
        private readonly int $id,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }
}
