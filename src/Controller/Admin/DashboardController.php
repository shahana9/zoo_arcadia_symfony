<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Report;
use App\Entity\Habitat;
use App\Entity\Service; 
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DashboardController extends AbstractDashboardController
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
        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            $url = $this->get(AdminUrlGenerator::class)->setController(UserCrudController::class)->generateUrl();
            return $this->redirect($url);
        } elseif ($this->authChecker->isGranted('ROLE_VETERINAIRE')) {
            
            return $this->render('veterinarian/dashboard.html.twig');
        } elseif ($this->authChecker->isGranted('ROLE_EMPLOYE')) {
            
            return $this->render('employee/dashboard.html.twig');
        } else {
            throw $this->createAccessDeniedException();
        }

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Arcadia - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        }

        if ($this->isGranted('ROLE_VETERINAIRE')) {
            yield MenuItem::linkToCrud('rapport-vétérinaire', 'fas fa-file-medical', Report::class);
            yield MenuItem::linkToCrud('Habitats', 'fas fa-leaf', Habitat::class);
        }

        if ($this->isGranted('ROLE_EMPLOYE')) {
            yield MenuItem::linkToCrud('Tâches', 'fas fa-comment', Avis::class);
            yield MenuItem::linkToCrud('Services', 'fas fa-tools', Service::class); 
            yield MenuItem::linkToCrud('Animal', 'fas fa-tiger', Animal::class);
        }
    }
}
