<?php

namespace App\Controller\Admin;

use App\Entity\ArtWork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtWorkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtWork::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('Title'),
            TextEditorField::new('description'),
            TextField::new('width'),
            TextField::new('hight'),
        ];
    }
    
}
