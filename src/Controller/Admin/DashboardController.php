<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Avis;
use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Report;
use App\Entity\Habitat;
use App\Entity\Service; 
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DashboardController extends AbstractController
{
    private AuthorizationCheckerInterface $authChecker;
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AuthorizationCheckerInterface $authChecker, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->authChecker = $authChecker;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
            return $this->redirect($url);
        } elseif ($this->isGranted('ROLE_VETERINAIRE')) {
            return $this->render('veterinarian/dashboard.html.twig');
        } elseif ($this->isGranted('ROLE_EMPLOYE')) {
            return $this->render('employee/dashboard.html.twig');
        } else {
            throw $this->createAccessDeniedException();
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Arcadia - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
    }
}
