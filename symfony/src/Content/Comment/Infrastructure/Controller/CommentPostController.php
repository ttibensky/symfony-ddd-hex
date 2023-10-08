<?php

declare(strict_types=1);

namespace App\Content\Comment\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\Controller;
use App\Content\Application\Service\GetContentService;
use App\Content\Comment\Application\Service\CreateCommentService;
use App\Content\Comment\Domain\Command\CreateCommentCommand;
use App\Content\Comment\Infrastructure\Form\CommentType;
use App\Content\Infrastructure\Routing\ContentRoutingFactory;
use App\Content\Domain\Query\GetContentQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentPostController extends Controller
{
    /**
     * @Route("/{_locale}/comment/{parentId}", name="comment_post", requirements={"_locale": "en|sk"}, methods="GET|POST")
     */
    public function post(
        int $parentId,
        Request $request,
        GetContentService $getContentService,
        CreateCommentService $createCommentService,
        ContentRoutingFactory $contentRoutingFactory,
    ): Response {

        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $query = new GetContentQuery($parentId);
            $content = $getContentService($query);

            $comment = $createCommentService(new CreateCommentCommand(
                $form->get('description')->getData(),
                $form->get('author')->getData(),
                $content,
            ));

            // @TODO this will not work when we allow comment replies
            $parent = $comment->getParent();

            return $this->redirectToRoute(
                $contentRoutingFactory->createGet($parent),
                ['id' => $parent->getId()]
            );
        }

        return $this->render(
            'content/comment/post.html.twig',
            [
                'form' => $form->createView(),
            ],
        );
    }
}
