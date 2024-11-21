<?php
namespace App\Controller\Admin;

use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField; // Import de ChoiceField

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('animal'),
            ChoiceField::new('race')
                ->setChoices([
                    'Grand singe' => 'grand singe',
                    'Mammifère' => 'mammifère',
                    'Amphibien' => 'amphibien',
                    'Félidé' => 'félidé',
                    'Reptile' => 'reptile',
                    'Giraffidae' => 'giraffidae',
                ]),
            AssociationField::new('habitat'),
            TextareaField::new('etat'),
            TextareaField::new('nourriture'),
            TextField::new('grammage'),
            DateTimeField::new('Date_passage') 
                ->setFormTypeOptions(['widget' => 'single_text']) //  un seul champ pour la date et l'heure//
                ->setLabel('Date du passage'),
        ];
            
    }

    // Acces autorisé pour Animal//
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::persistEntity($entityManager, $entityInstance);
    }

    // Mise à jour autorisée pour Animal//
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);
    }

    // Suppression autorisée pour Animal//
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
