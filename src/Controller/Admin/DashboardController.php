<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Report;
use App\Entity\Animal;
use App\Entity\ServicePage;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\Admin\AnimalCrudController;
use App\Controller\Admin\ServicePageCrudController;
use App\Entity\Habitat;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        //  return $this->redirect($this->adminUrlGenerator->setController(ServicePageCrudController::class)->generateUrl());


        if ($this->isGranted('ROLE_ADMIN')) {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            $url = $adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
            return $this->redirect($url);
        }

        if ($this->isGranted('ROLE_VETERINAIRE')) {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            $url = $adminUrlGenerator->setController(ReportCrudController::class)->generateUrl();
            return $this->redirect($url);
        }

        if ($this->isGranted('ROLE_EMPLOYE')) {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            $url = $adminUrlGenerator->setController(ServicePageCrudController::class)->generateUrl();
            return $this->redirect($url);
        }

        if ($this->isGranted('ROLE_USER')) {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            $url = $adminUrlGenerator->setController(AnimalCrudController::class)->generateUrl();
            return $this->redirect($url);
        }

        throw $this->createAccessDeniedException();
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Arcadia - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
            yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
        }

        // Visible uniquement pour les vétérinaires et Admin
        if ($this->isGranted('ROLE_VETERINAIRE') || $this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Rapport médicaux', 'fas fa-notes-medical', Report::class);
            yield MenuItem::linkToCrud('Habitat', 'fas fa-paw', Habitat::class);
        }

        // Visible uniquement pour les employés et les admins
        if ($this->isGranted('ROLE_EMPLOYE') || $this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Page de Service', 'fas fa-file-alt', ServicePage::class);
            yield MenuItem::linkToRoute('Manage Avis', 'fa fa-comment', 'admin_avis_list');
        }
        
        //Visible pour tout le monde//
        yield MenuItem::linkToCrud('Animaux', 'fa fa-list', Animal::class);
        yield MenuItem::linkToLogout('Se déconnecter', 'fas fa-power-off');
    }
}
