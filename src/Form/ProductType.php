<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class  ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('created', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('file', FileType::class, [
                'label' => 'Product Image',
                'required' => false,
                'mapped' => false
            ])
            ->add('cid', EntityType::class, [
                'class'=>Category::class,
                'choice_label'=>'name'
            ])
            ->add('sup', EntityType::class, [
                'class'=>Supplier::class,
                'choice_label'=>'name'
            ])
            ->add('image', HiddenType::class, [
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => "Confirm"
            ]);
    }
}
