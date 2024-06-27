<?php

namespace App\Form;

use App\Entity\UE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeUE', null,[
                'label' => ' ',
            ])
            ->add('name', null,[
                'label' => ' ',
            ])
            ->add('description', null,[
                'label' => ' ',
            ], TextType::class)
            ->add('credit', null,[
                'label' => ' ',
            ], NumberType::class)
            ->add('semester', null,[
                'label' => ' ',
            ])
            ->add('level', null,[
                'label' => ' ',
            ])
            ->add('fields', null,[
                'label' => ' ',
            ])
            ->add('submit', SubmitType::class)
            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
        ]);
    }
}
