<?php

declare(strict_types = 1);

namespace App\Feed\Infrastructure\Controller;

use App\Common\Infrastructure\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller handles the main page - feed, which is a list of Content.
 */
class FeedGetController extends Controller
{
    /**
     * @Route("/", name="homepage_without_locale")
     */
    public function homepageWithoutLocale(Request $request): Response
    {
        // @TODO add more supported languages
        return $this->redirectToRoute('feed_get', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale}", name="homepage_without_feed")
     */
    public function homepageWithoutFeed(Request $request): Response
    {
        // @TODO add more supported languages
        return $this->redirectToRoute('feed_get', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale}/feed", name="feed_get", requirements={"_locale": "en|sk"})
     */
    public function get(): Response
    {
        return new Response('I am feed!');
    }
}
