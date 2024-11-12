<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Entity\User;
use App\Entity\Report;
use App\Entity\ServicePage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

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
            return $this->render('veterinarian/dashboard.html.twig');
        }
        
        if ($this->isGranted('ROLE_EMPLOYE')) {
            return $this->render('employee/dashboard.html.twig');
        }

        throw $this->createAccessDeniedException();

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Arcadia - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        // Visible pour tous les rôles (ADMIN, VETERINAIRE, EMPLOYE)
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);

        // Visible uniquement pour les vétérinaires
        if ($this->isGranted('ROLE_VETERINAIRE')) {
            yield MenuItem::linkToCrud('Rapport médicaux', 'fas fa-notes-medical', Report::class);
        }

        // Visible uniquement pour les employés et les admins
        if ($this->isGranted('ROLE_EMPLOYE') || $this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Page de Service', 'fas fa-file-alt', ServicePage::class);
        }

        yield MenuItem::linkToLogout('Se déconnecter', 'fas fa-power-off');

        //     // Visible uniquement pour les administrateurs
        //     if ($this->isGranted('ROLE_ADMIN')) {
        //         yield MenuItem::linkToCrud('Paramètres Admin', 'fas fa-cogs', AdminSettings::class);
        // }
    }

}
