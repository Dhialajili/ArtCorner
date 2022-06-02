<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\ArtWork;
use App\Entity\Category;
use App\Entity\Style;
use App\Entity\Subject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class ArtWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title')
            ->add('description')
            ->add('width',NumberType::class)
            ->add('hight',NumberType::class)
            ->add('materialsUsed')
            
            
            ->add('price',NumberType::class)
            
            ->add('category',EntityType::class,array(
                'class'=> Category::class,
                
                'multiple'=>false,
                'choice_label' => 'name',

            ))

            ->add('subject',EntityType::class,array(
                'class'=>Subject::class,
                'choice_label' => 'name',
                'multiple'=>false,
            ))
            ->add('style',EntityType::class,array(
                'class'=>Style::class,
                'choice_label' => 'name',
                'multiple'=>false,
            ))
            ->add('imageFile',VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArtWork::class,
        ]);
    }
}
