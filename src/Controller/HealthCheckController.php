<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/', name: 'app_health_check', methods: ['GET'])]
final class HealthCheckController extends AbstractController
{
    public function __invoke(): Response
    {
        return new Response('ok');
    }
}
