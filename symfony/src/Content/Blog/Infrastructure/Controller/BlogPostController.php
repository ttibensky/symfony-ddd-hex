<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\Controller;
use App\Content\Blog\Application\Service\CreateBlogService;
use App\Content\Blog\Domain\Command\CreateBlogCommand;
use App\Content\Blog\Infrastructure\Form\BlogType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends Controller
{
    /**
     * @Route("/{_locale}/blog", name="blog_post", requirements={"_locale": "en|sk"}, methods="GET|POST")
     */
    public function post(
        Request $request,
        CreateBlogService $createBlogService
    ): Response {
        $form = $this->createForm(BlogType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $blog = $createBlogService(new CreateBlogCommand(
                $form->get('title')->getData(),
                $form->get('description')->getData(),
                $form->get('author')->getData(),
            ));

            return $this->redirectToRoute('blog_get', ['id' => $blog->getId()]);
        }

        return $this->render(
            'content/blog/post.html.twig',
            [
                'form' => $form->createView(),
            ],
        );
    }
}
