<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EECollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('totalPoints', ChoiceType::class, [
            'choices' => array_combine(range(20, 100, 10), range(20, 100, 10)),
            'label' => 'Note maximale',
            'required' => true,
        ])            
            ->add('ees', CollectionType::class, [
                'entry_type' => EeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => false,
                'allow_delete' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}