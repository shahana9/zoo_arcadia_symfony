<?php

namespace App\Controller\Admin;

use App\Entity\ServicePage;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServicePageCrudController extends AbstractCrudController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return ServicePage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pages de Service')
            ->setEntityLabelInSingular('Page de Service');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('Title','Titre'),
            TextField::new('SubTitle1','Sous-titre'),
            TextField::new('SubTitle2', 'Sous-titre'),
            TextField::new('SubTitle3', 'Sous-titre'),
            TextareaField::new('Content', 'Contenu'),
            ImageField::new('images')
                ->setBasePath('assets/images')
                ->setUploadDir('assets/images')
                ->setRequired(false)
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->displayIf(function () {
                    return $this->security->isGranted('ROLE_EMPLOYEE') || $this->security->isGranted('ROLE_ADMIN');
                });
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->displayIf(function () {
                    return $this->security->isGranted('ROLE_EMPLOYEE') || $this->security->isGranted('ROLE_ADMIN');
                });
            });
    }
}