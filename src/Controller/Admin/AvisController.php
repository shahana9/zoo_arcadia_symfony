<?php

namespace App\Controller\Admin;

use App\Document\Avis;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AvisController extends AbstractController
{

    private $dm;
    private $adminUrlGenerator;

    public function __construct(DocumentManager $dm, AdminUrlGenerator $adminUrlGenerator)

    {
        $this->dm = $dm;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin/avis/list', name: 'admin_avis_list')]
    public function listAvis(): Response
    {
        $avislist = $this->dm->getRepository(Avis::class)->findAll();

        return $this->render('admin/avis_list.html.twig', [
            'avisList' => $avislist
        ]);
    }

    #[Route('/admin/avis/{id}/validate', name: 'admin_validate_avis')]
    public function validateAvis($id): Response
    {
        $avis = $this->dm->getRepository(Avis::class)->find($id);
        if ($avis) {
            $avis->setIsValidated(true);
            $this->dm->flush();
        }

        $url = $this->adminUrlGenerator
        ->setRoute('admin_avis_list')
        ->generateUrl();

        return $this->redirect($url);
    }

    #[Route('/admin/avis/{id}/delete', name: 'admin_delete_avis')]
    public function deleteAvis($id): RedirectResponse
    {
        $avis = $this->dm->getRepository(Avis::class)->find($id);
        if ($avis) {
            $this->dm->remove($avis);
            $this->dm->flush();
        }

        $url = $this->adminUrlGenerator
            ->setRoute('admin_avis_list')
            ->generateUrl();

        return $this->redirect($url);
    }
}
