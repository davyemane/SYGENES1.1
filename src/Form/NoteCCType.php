<?php

namespace App\Form;

use App\Entity\EC;
use App\Entity\NoteCcTp;
use App\Entity\Student;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteCCType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cc')
            ->add('tp')
            ->add('hasTp')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('eC', EntityType::class, [
                'class' => EC::class,
                'choice_label' => 'id',
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'id',
            ])
            ->add('createb_by', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NoteCcTp::class,
        ]);
    }
}
