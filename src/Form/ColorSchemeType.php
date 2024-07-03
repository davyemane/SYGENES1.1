<?php

namespace App\Form;

use App\Entity\ColorScheme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColorSchemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du schéma',
            ])
            ->add('primaryColor', ColorType::class, [
                'label' => 'Couleur primaire',
            ])
            ->add('secondaryColor', ColorType::class, [
                'label' => 'Couleur secondaire',
            ])
            ->add('accentColor', ColorType::class, [
                'label' => 'Couleur d\'accent',
            ])
            ->add('bacgroundColor', ColorType::class, [
                'label' => 'Couleur de fond',
            ])
            ->add('textColor', ColorType::class, [
                'label' => 'Couleur du texte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ColorScheme::class,
        ]);
    }
}