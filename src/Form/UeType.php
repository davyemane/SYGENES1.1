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
            ->add('codeUE')
            ->add('name')
            ->add('description', TextType::class)
            ->add('credit', NumberType::class)
            ->add('semester')
            ->add('level')
            ->add('fields')
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
