<?php

namespace App\Common\Domain\Util;

use App\Common\Domain\Router\RouterInterface;

readonly class Paginator
{
    public const DEFAULT_URL_PARAM_NAME = 'page';
    private int $totalPages;

    public function __construct(
        private RouterInterface $router,
        private string $route,
        private array $routeParams = [],
        private int $currentPage = 1,
        private int $recordsPerPage = 10,
        private string $urlParamName = self::DEFAULT_URL_PARAM_NAME,
    ) {
    }

    public function setTotalRecords(int $totalRecords): self
    {
        $this->totalPages = ceil($totalRecords / $this->recordsPerPage);

        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getUrl($page = null): string
    {
        $params = $this->routeParams;
        $params[$this->urlParamName] = $page ?: $this->getCurrentPage();

        return $this->router->generateUrl(
            $this->route,
            $params
        );
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getRecordsPerPage(): int
    {
        return $this->recordsPerPage;
    }

    public function getOffset(): int
    {
        return ($this->getRecordsPerPage() * $this->getCurrentPage()) - $this->getRecordsPerPage();
    }
}
