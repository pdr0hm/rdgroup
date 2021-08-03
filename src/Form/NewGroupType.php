<?php

namespace App\Form;

use App\Entity\Grupo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class NewGroupType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nomeGrupo', TextType::class)
        ->add('apresentacao', TextareaType::class)
        ->add('visibilidade', CheckboxType::class, [
            'attr' => ['class' => 'slider round'], //atributo propriedade,
            'required' => false 
        ])
        ->add('fotoCapa', FileType::class, [
            'label' =>  'Foto de Capa',
            'mapped' => false,
            'required' => false,  
            'constraints' => [
                new File([
                    'maxSize' => '1024k',                    
                    'mimeTypesMessage' => 'Favor enviar arquivo PNG/JPEG válido',
                ])
            ],
        ])
        ->add('save', SubmitType::class);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grupo::class,
        ]);
    }


}