<?php

namespace App\Common\Infrastructure\Router;

use App\Common\Domain\Router\RouterInterface;
use Symfony\Component\Routing\RouterInterface as SymfonyRouter;

readonly class Router implements RouterInterface
{
    public function __construct(
        private SymfonyRouter $symfonyRouter
    ) {}

    public function generateUrl(string $route, array $arguments): string
    {
        return $this->symfonyRouter->generate($route, $arguments);
    }
}
