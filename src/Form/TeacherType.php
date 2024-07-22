<?php

namespace App\Form;

use App\Entity\EC;
use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cni')
            ->add('phone_number')
            ->add('ecs', EntityType::class, [
                'class' => EC::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'choices' => $options['ec_choices'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
            'ec_choices' => [],
        ]);
    }}
