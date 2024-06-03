<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(): Response
    {
        return $this->render('habitats/habitats.html.twig', [
            'controller_name' => 'HabitatsController',
            'title' => 'Habitats',
        ]);
    }
    #[Route('/habitat/edit', name: 'habitat_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(): Response
    {
        return $this->render('habitat/edit.html.twig');
    }
}
