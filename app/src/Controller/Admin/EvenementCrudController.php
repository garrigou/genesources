<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('source')
            ->setFormTypeOptions([
                'by_reference' => true,
            ])
            ->autocomplete(),
            AssociationField::new('personne')
            ->setFormTypeOptions([
                'by_reference' => true,
            ])
            ->autocomplete(),
            AssociationField::new('type')
            ->setFormTypeOptions([
                'by_reference' => true,
            ])
            ->autocomplete(),
            DateField::new('date'),
            TextField::new('description'),
        ];
    }
}
