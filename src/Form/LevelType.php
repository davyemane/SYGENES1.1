<?php

namespace App\Form;

use App\Entity\Field;
use App\Entity\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class LevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $schoolName = $options['school_name'];

        $builder
            ->add('name')
            ->add('fields', EntityType::class, [
                'class' => Field::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) use ($schoolName) {
                    return $er->createQueryBuilder('f')
                        ->join('f.school', 's')
                        ->where('s.name = :schoolName')
                        ->setParameter('schoolName', $schoolName);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Level::class,
            'school_name' => null,
        ]);

        $resolver->setRequired('school_name');
    }
}