<?php

namespace App\Controller;

use App\Repository\CampervanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampervanController extends AbstractController
{
    public function __construct(protected CampervanRepository $campervanRepository)
    {
    }

    #[Route('/campervan', name: 'campervan_list')]
    public function index(): Response
    {
        $campervans = $this->campervanRepository->findAll();

        return $this->json($campervans);
    }
}
