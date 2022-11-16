<?php

declare(strict_types=1);

namespace App\Module\Page\Controller;

use App\Storage\Repository\ArticleRepository;
use App\Storage\Repository\NotificationRepository;
use App\Storage\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/', name: 'app_index')]
final class IndexController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly SponsorRepository $sponsorRepository,
        private readonly NotificationRepository $notificationRepository,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return $this->render('@page/index.html.twig', [
            'article'       => $this->articleRepository->findOneLatestEnabled(),
            'sponsors'      => $this->sponsorRepository->findEnabled(),
            'notifications' => $this->notificationRepository->findEnabled(),
        ]);
    }
}
