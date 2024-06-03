<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(): Response
    {
        return $this->render('services/services.html.twig', [
            'title' => 'Services',
        ]);
    }
    #[Route('/service/edit', name: 'service_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(): Response
    {
        return $this->render('service/edit.html.twig');
    }
}
