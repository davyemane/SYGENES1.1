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
        $userField = $options['user_field'];

        $builder
            ->add('name')
            ->add('field', EntityType::class, [
                'class' => Field::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) use ($schoolName, $userField) {
                    return $er->createQueryBuilder('f')
                        ->join('f.school', 's')
                        ->where('s.name = :schoolName')
                        ->andWhere('f = :userField')
                        ->setParameter('schoolName', $schoolName)
                        ->setParameter('userField', $userField);
                },
                'placeholder' => 'Sélectionnez une filière',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Level::class,
            'school_name' => null,
            'user_field' => null,
        ]);

        $resolver->setRequired(['school_name', 'user_field']);
    }
}
