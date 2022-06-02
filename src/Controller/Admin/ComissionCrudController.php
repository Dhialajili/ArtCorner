<?php

namespace App\Controller\Admin;

use App\Entity\Comission;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ComissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comission::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
