<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Busca', TextType::class, [
            'required' => false
        ], ['attr' => [
          'placeholder' => 'Busque aqui uma Rede Docente', 
          'class' => 'form-signup'
        ], 'label' => false ])
        ->add('search', SubmitType::class, [
            'attr' => [
                'class' => 'btn'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grupo::class,
        ]);
    }

}