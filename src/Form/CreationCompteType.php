<?php

namespace App\Form;

use App\Entity\UserProf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices'=>[
                    'Professeur'=>'ROLE_AUTEUR',
                    'Utilisateur simple'=>'ROLE_USER'
                ]
            ])
            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('date_de_naissance')
            ->add('pseudo')
            ->add('numen')
            ->add('follow')
            ->add('Soumettre', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProf::class,
        ]);
    }
}
