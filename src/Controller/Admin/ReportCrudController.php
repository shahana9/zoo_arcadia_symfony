<?php

namespace App\Controller\Admin;

use App\Entity\Report;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Report::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Rapports médicaux')
            ->setEntityLabelInSingular('Rapport médical')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Rapports médicaux')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer un Rapport médical')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un Nouveau Rapport médical')
            ->setDefaultSort(['created_at' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            DateTimeField::new('created_at', 'Date de Création')->setFormTypeOptions(['widget' => 'single_text']),
            TextField::new('nomAnimal', 'Nom de l\'Animal'),
            TextField::new('race', 'Race'),
            TextField::new('habitat', 'Habitat'),
            TextField::new('detail', 'Détail'),
            TextareaField::new('commentaires', 'Commentaires'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->displayIf(function () {
                    return $this->isGranted('ROLE_VETERINAIRE') || $this->isGranted('ROLE_ADMIN');
                });
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->displayIf(function () {
                    return $this->isGranted('ROLE_VETERINAIRE') || $this->isGranted('ROLE_ADMIN');
                });
            });
    }
}
