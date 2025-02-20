<?php

namespace App\Controller;

use App\Repository\MarketplaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class MarketplaceController extends AbstractController
{
    public function __construct(private MarketplaceRepository $marketplaceRepository)
    {
    }

    #[Route('/marketplace', name: 'app_marketplace')]
    public function index(): JsonResponse
    {
        $marketplaces = $this->marketplaceRepository->findAll();

        $marketplacesNames = array_map(fn($marketplace) => $marketplace->getName(), $marketplaces);

        return $this->json([
            'marketplaces' => $marketplacesNames,
        ]);
    }
}
