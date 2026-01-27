<?php

namespace App\Controller\Admin;

use App\Entity\Lanterne;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LanterneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lanterne::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('spe'),
            IntegerField::new('prix'),
            TextEditorField::new('description'),
        ];
    }
}
