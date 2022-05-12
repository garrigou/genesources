<?php

namespace App\Controller\Admin;

use App\Entity\Personne;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class PersonneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personne::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            DateField::new('dateNaissance'),
            DateField::new('dateDeces'),
            AssociationField::new('pere')
                ->setFormTypeOptions([
                    'by_reference' => true,
                ])
                ->autocomplete(),
                AssociationField::new('mere')
                ->setFormTypeOptions([
                    'by_reference' => true,
                ])
                ->autocomplete(),                
        ];
    }
    
}
