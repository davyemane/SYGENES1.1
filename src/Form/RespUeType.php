<?php

namespace App\Form;

use App\Entity\RespUe;
use App\Entity\UE;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RespUeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('cni')
            ->add('email')
            ->add('phone_number')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('ue', EntityType::class, [
                'class' => UE::class,
                'choice_label' => 'id',
            ])
            ->add('created_by', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RespUe::class,
        ]);
    }
}