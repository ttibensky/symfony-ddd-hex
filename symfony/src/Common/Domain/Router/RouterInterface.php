<?php

declare(strict_types=1);

namespace App\Common\Domain\Router;

interface RouterInterface
{
    public function generateUrl(string $route, array $arguments): string;
}
