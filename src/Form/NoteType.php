<?php

namespace App\Form;

use App\Entity\EC;
use App\Entity\Note;
use App\Entity\Responsable;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cc', null, [
                'label' => ' ',
            ])
            ->add('tp',  null, [
                'label' => ' ',
            ]
            )
            ->add('sn', null, [
                'label' => ' ',
            ])
            ->add('semester',  null, [
                'label' => ' ',
            ])
            ->add('rattrapage',  null, [
                'label' => ' ',
            ])
            ->add('created_at', HiddenType::class)
            //->add('createb_by', EntityType::class, ['class'=> User::class, 'choice_label' => 'id',])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'name',
                'label' => ' ',
            ])
            ->add('ec', EntityType::class, [
                'class' => EC::class,
                'choice_label' => 'name',
                'label' => ' ',
            ])
            ->add('submit', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
