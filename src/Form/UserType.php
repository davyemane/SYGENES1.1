<?php
// src/Form/UserType.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            // ->add('currentPassword', PasswordType::class, [
            //     'mapped' => false,
            //     'required' => false,
            //     'label' => 'Current Password',
            //     'attr' => ['class' => 'form-control'],
            // ])
            // ->add('newPassword', RepeatedType::class, [
            //     'type' => PasswordType::class,
            //     'mapped' => false,
            //     'required' => false,
            //     'first_options'  => [
            //         'label' => 'New Password',
            //         'attr' => ['class' => 'form-control'],
            //     ],
            //     'second_options' => [
            //         'label' => 'Confirm New Password',
            //         'attr' => ['class' => 'form-control'],
            //     ],
            // ])
            ->add('profilePicture', FileType::class, [
                'label' => 'Profile Picture (JPEG or PNG file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG or PNG)',
                    ])
                ],
                'attr' => ['class' => 'form-control'],
            ])
            // Ajoutez d'autres champs que vous voulez permettre de modifier
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
