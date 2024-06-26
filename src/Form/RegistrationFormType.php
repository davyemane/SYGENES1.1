<?php

namespace App\Form;

use App\Entity\Responsable;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      
        // ... other fields
        ->add('profilePicture', FileType::class, [
            'label' => ' ',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid image file (JPG or PNG)',
                ])
            ],
        ])

            ->add('username', null, [
                'label' => ' ',])
            ->add('email',  null, [
                'label' => ' ',])
            ->add('student',  null, [
                'label' => ' ',])

            ->add('Responsable', null, [
                'label' => ' ',])
            ->add('roles', ChoiceType::class, [
                'label' => ' ',
                'choices'  => [ // Define your available roles here
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_TEACHER' => 'ROLE_TEACHER',
                    'ROLE_CEP' => 'ROLE_CEP',
                    'ROLE_SA' => 'ROLE_SA',
                    'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN'
                    // ... other roles
                ],
                'expanded' => true, // Allows selecting multiple roles (checkbox style)
                'multiple' => true, // Allows selecting multiple roles
            ])
        
            ->add('agreeTerms', CheckboxType::class, [
                'label' => ' ',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => ' ',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
