<?php

namespace App\Form;

use App\Entity\Privilege;
use App\Entity\Role;
use App\Entity\School;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('school', EntityType::class, [
                'class' => School::class,
                'choice_label' => 'name',
            ])
            ->add('privileges', EntityType::class, [
                'class' => Privilege::class,
                'choice_label' => 'name', // Assurez-vous que votre entité Privilege a un champ 'name'
                'multiple' => true,
                'expanded' => true, // Ceci transforme le select en cases à cocher
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
