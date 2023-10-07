<?php

declare(strict_types=1);

namespace App\Content\Domain\Repository;

use App\Common\Domain\Model\PagedList;
use App\Content\Domain\Model\ContentSearch;

interface ContentRepository
{
    public function search(ContentSearch $contentSearch): PagedList;
}
