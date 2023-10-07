<?php

declare(strict_types=1);

namespace App\Common\Domain\Model;

readonly class PagedList
{
    public function __construct(
        private iterable $data,
        private int $total,
    ) {
    }

    public function getData(): iterable
    {
        return $this->data;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
