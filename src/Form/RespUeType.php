<?php

namespace App\Form;

use App\Entity\RespUe;
use App\Entity\UE;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RespUeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cni')
            ->add('phone_number')
            ->add('ue', EntityType::class, [
                'class' => UE::class,
                'choices' => $options['ue_choices'],
                'choice_label' => 'name',
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RespUe::class,
            'ue_choices' => null,
        ]);
    }}
