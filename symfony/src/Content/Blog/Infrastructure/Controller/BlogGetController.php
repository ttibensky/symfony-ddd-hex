<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\Controller;
use App\Content\Blog\Application\Service\GetBlogService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogGetController extends Controller
{
    /**
     * @Route("/{_locale}/blog/{id}", name="blog_get", requirements={"_locale": "en|sk"})
     */
    public function get(int $id, GetBlogService $getBlogService): Response
    {
        $blog = $getBlogService($id);

        return $this->render(
            'content/blog/detail.html.twig',
            [
                'blog' => $blog,
            ],
        );
    }
}
