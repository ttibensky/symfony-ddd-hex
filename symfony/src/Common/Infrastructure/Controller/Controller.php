<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * This is a good place to hold small reusable bits of controller functionality, such as commonly used services (translator) injection.
 */
class Controller extends AbstractController
{
    /**
     * Controller constructor.
     */
    public function __construct(
        protected readonly TranslatorInterface $translator,
    ) {}
}
