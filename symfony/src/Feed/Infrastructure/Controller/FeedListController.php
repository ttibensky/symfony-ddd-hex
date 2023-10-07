<?php

declare(strict_types = 1);

namespace App\Feed\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\Controller;
use App\Content\Application\Service\SearchContentService;
use App\Content\Domain\Model\ContentSearch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller handles the main page - feed, which is a list of Content.
 */
class FeedListController extends Controller
{
    /**
     * @Route("/", name="homepage_without_locale")
     */
    public function homepageWithoutLocale(Request $request): Response
    {
        // @TODO add more supported languages
        return $this->redirectToRoute('feed_index', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale}", name="homepage_without_feed")
     */
    public function homepageWithoutFeed(Request $request): Response
    {
        // @TODO add more supported languages
        return $this->redirectToRoute('feed_index', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale}/feed", name="feed_index", requirements={"_locale": "en|sk"})
     */
    public function get(SearchContentService $searchContentService): Response
    {
        $contentSearch = new ContentSearch();
        $pagedList = $searchContentService($contentSearch);

        return $this->render(
            'feed/index.html.twig',
            [
                'pagedList' => $pagedList,
            ],
        );
    }
}
