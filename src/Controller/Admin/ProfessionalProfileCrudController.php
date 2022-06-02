<?php

namespace App\Controller\Admin;

use App\Entity\ProfessionalProfile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfessionalProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfessionalProfile::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('username'),
            
            
            TextField::new("profileimageFile","Artist")
            ->setFormType(VichImageType::class)
            ->hideOnIndex()
            ->setFormTypeOption("allow_delete",false)
            ,
            ImageField::new("profilePicture")->setBasePath("/uploads/profiles")->onlyOnIndex(),
            
        ];
    }
}
