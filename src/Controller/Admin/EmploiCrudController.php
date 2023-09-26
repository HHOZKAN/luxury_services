<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emploi::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        return [
            AssociationField::new('client')->autocomplete(),
            TextField::new('reference'),
            TextEditorField::new('description'),
            BooleanField::new('activation'),
            TextField::new('titre_offre'),
            TextField::new('type_offre'),
            TextField::new('location'),
            TextField::new('job_category'),
            MoneyField::new('salaire')->setCurrency('EUR'),
            DateTimeField::new('date_create')->hideOnForm()
        ];
    }
    
}
