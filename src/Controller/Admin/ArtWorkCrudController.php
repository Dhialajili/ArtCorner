<?php

namespace App\Controller\Admin;

use App\Entity\ArtWork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
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
            NumberField::new('width'),
            NumberField::new('hight'),
            TextField::new("imageFile")->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new("image")->setBasePath("/uploads/artworks")->onlyOnIndex(),
        ];
    }
    
}
