<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Entity\User;
use App\Entity\ServicePage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

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
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);

        if ($this->isGranted('ROLE_EMPLOYEE') || $this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Page de Service', 'fas fa-file-alt', ServicePage::class);
        }

        yield MenuItem::linkToLogout('Se déconnecter', 'fas fa-power-off');
    }

}