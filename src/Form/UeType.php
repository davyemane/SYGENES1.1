<?php

namespace App\Form;

use App\Entity\UE;
use App\Entity\Field;
use App\Entity\Level;
use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class UeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $school = $options['school'];

        $builder
            ->add('codeUE', null, [
                'label' => ' ',
            ])
            ->add('name', null, [
                'label' => ' ',
            ])
            ->add('description', TextType::class, [
                'label' => ' ',
            ])
            ->add('credit', NumberType::class, [
                'label' => ' ',
            ])
            ->add('semester', null, [
                'label' => ' ',
            ])
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'name',
                'label' => ' ',
                'query_builder' => function (EntityRepository $er) use ($school) {
                    $qb = $er->createQueryBuilder('l');
                    if ($school instanceof School) {
                        $qb->join('l.fields', 'f')
                           ->join('f.school', 's')
                           ->where('s = :school')
                           ->setParameter('school', $school)
                           ->distinct();
                    }
                    return $qb;
                },
            ])
            ->add('fields', EntityType::class, [
                'class' => Field::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => ' ',
                'query_builder' => function (EntityRepository $er) use ($school) {
                    $qb = $er->createQueryBuilder('f');
                    if ($school instanceof School) {
                        $qb->where('f.school = :school')
                           ->setParameter('school', $school);
                    }
                    return $qb;
                },
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
            'school' => null,
        ]);
    }
}