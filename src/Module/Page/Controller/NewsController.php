<?php

declare(strict_types=1);

namespace App\Module\Page\Controller;

use App\Storage\Repository\ArticleRepository;
use App\Storage\Repository\SponsorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/news', name: 'app_news')]
final class NewsController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly SponsorRepository $sponsorRepository,
        private readonly PaginatorInterface $paginator,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $query = $this->articleRepository
            ->createQueryBuilder('p')
            ->where('p.enabled = true')
            ->orderBy('p.id', 'DESC');

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
        );

        return $this->render('@page/news/index.html.twig', [
            'articles' => $pagination,
            'sponsors' => $this->sponsorRepository->findEnabled(),
        ]);
    }
}