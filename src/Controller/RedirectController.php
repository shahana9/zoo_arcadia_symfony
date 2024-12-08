<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/', name: 'redirect_to_accueil')]
    public function redirectToHome(): Response
    {
        return $this->redirectToRoute('app_accueil', [], 301);
    }
}
