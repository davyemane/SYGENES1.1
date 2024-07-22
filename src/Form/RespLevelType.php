<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\RespLevel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RespLevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cni')
            ->add('phone_number')
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choices' => $options['level_choices'],
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RespLevel::class,
            'level_choices' => null,
        ]);
    }
}