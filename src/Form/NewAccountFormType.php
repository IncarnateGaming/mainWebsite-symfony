<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'help'=>'Used for account identification and recovery. We only send out emails when major changes occur (such as the domain name change back in 2018).',
            ])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options' => ['label' => 'Password', 'help'=>'Passwords are hashed with Sodium (as of January 2020) and setup to automatically use new hash methods as they become available (https://symfony.com/blog/new-in-symfony-4-3-native-password-encoder) We highly recommend using a unique non-dictionary password as the risk of someone stealing hashes does still exist.'],
                'second_options'=> ['label' => 'Confirm Password']
            ])
            ->add('discordName', TextType::class,[
                'required'=>false,
                'label'=>'Discord Name*',
                'help'=>'Remember to include your #0000 at the end that uniquely identifies your discord.'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }


}
