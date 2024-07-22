<?php

namespace App\Controller;

use App\Entity\ServicePage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/services', name: 'app_services')]
    public function index(): Response
    {

        $serviceRepository = $this->entityManager->getRepository(ServicePage::class);
        $services = $serviceRepository->findAll();
        return $this->render('services/services.html.twig', [
            'services' => $services,
            'title' => 'Services',
        ]);
    }
}
