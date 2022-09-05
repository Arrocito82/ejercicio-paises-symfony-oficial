<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FronteraController extends AbstractController
{
    #[Route('/frontera', name: 'app_frontera')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/FronteraController.php',
        ]);
    }

    public function show(ManagerRegistry $doctrine, int $codigoPais): Response{
        $pais = $doctrine->getRepository(Pais::class)->find($codigoPais);
        $categoryName = $product->getCategory()->getName();
    }

}
