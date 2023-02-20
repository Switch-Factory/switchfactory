<?php

namespace App\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class, [
                'label' => "Confirm"
            ]);
    }
}
