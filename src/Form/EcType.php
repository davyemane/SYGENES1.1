<?php

namespace App\Form;

use App\Entity\EC;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeEc', null,[
                'label' => ' ',
            ])
            ->add('name', null,[
                'label' => ' ',
            ])
            // ->add('descrption', TextType::class)
            ->add('credit', null,[
                'label' => ' ',
            ])
            ->add('ue', null,[
                'label' => ' ',
            ])
            ->add('submit', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EC::class,
        ]);
    }
}
