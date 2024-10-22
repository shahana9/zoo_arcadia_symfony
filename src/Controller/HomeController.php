<?php

namespace App\Controller;

use App\Document\Avis;
use App\Form\AvisType;
use App\Service\AvisService;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $avisService;

    public function __construct(AvisService $avisService) 
    {
        $this->avisService = $avisService;
    }

    #[Route('/home', name: 'app_accueil')]
    public function index(Request $request, DocumentManager $documentManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->persist($avis);
            $documentManager->flush();

            $this->addFlash('success', 'Votre avis a été enregistré avec succès !');

            return $this->redirectToRoute('app_accueil');
        }

        // Récupérer les avis validés 
        $validatedAvis = $this->avisService->getValidatedAvis();

        return $this->render('home/home.html.twig', [
            'title' => 'Accueil',
            'form' => $form->createView(),
            'validatedAvis' => $validatedAvis,
        ]);
    }
}
