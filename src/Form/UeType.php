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
            ->add('codeUE', TextType::class, [
                'label' => 'Code UE',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'UE',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('credit', NumberType::class, [
                'label' => 'Crédits',
            ])
            ->add('semester', TextType::class, [
                'label' => 'Semestre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
        ]);
    }
}