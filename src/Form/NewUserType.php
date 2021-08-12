<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nome', TextType::class, [
          'attr' => [
            'placeholder' => 'Nome', 
            'class' => 'form-signup'
          ], 
          'label' => false
          ])
        ->add('email', TextType::class, [
          'attr' => [
            'placeholder' => 'Email',
            'class' => 'form-signup'
          ],
          'label' => false
        ])
        ->add('password', TextType::class, [
          'attr' => [
          'placeholder' => 'Senha',
          'class' => 'form-signup'
        ],
        'label' => false
        ])
        ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }

}

