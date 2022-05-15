<?php

namespace App\Controller\Admin;

use App\Entity\ArtWork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Polyfill\Intl\Idn\Idn;
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
            IdField::new('id')->onlyOnIndex(),
            TextField::new('Title'),
            NumberField::new("width")->hideOnIndex(),
            NumberField::new("hight")->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            TextareaField::new('materials_used')->hideOnIndex(),
            TextField::new("imageFile","Artwork")
            ->setFormType(VichImageType::class)
            ->hideOnIndex()
            ->setFormTypeOption("allow_delete",false)
            ,
            ImageField::new("image")->setBasePath("/uploads/artworks")->onlyOnIndex(),
            DateField::new('createdAt')->onlyOnIndex()
        ];
    }
    
}
