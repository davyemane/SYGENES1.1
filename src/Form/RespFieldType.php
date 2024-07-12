<?php

namespace App\Form;

use App\Entity\Field;
use App\Entity\RespField;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RespFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('cni')
            ->add('phone_number')
            ->add('email')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('field', EntityType::class, [
                'class' => Field::class,
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
            'data_class' => RespField::class,
        ]);
    }
}
