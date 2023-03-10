<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('email', EmailType::class)
        ->add('phone', TextType::class )
        ->add('address', TextType::class)
        ->add('birthday',DateType::class,['widget' => 'single_text'])
        ->add('save', SubmitType::class, ['label'=>'Change']);
    }

    // public function configureOptions(OptionsResolver $resolver):void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => User::class,
    //     ]);
    // }
}
