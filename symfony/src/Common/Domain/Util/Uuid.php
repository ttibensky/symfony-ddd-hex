<?php

declare(strict_types=1);

namespace App\Common\Domain\Util;

use Ramsey\Uuid\Uuid as BaseUuid;

class Uuid
{
    public function __construct(protected string $id)
    {
        if (!$this->isValid($id)) {
            new \InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }

        $this->id = $id;
    }

    public static function generate(): string
    {
        return BaseUuid::uuid4()->toString();
    }

    public function value(): string
    {
        return $this->id;
    }

    private function isValid(string $id): bool
    {
        return BaseUuid::isValid($id);
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
