<?php

namespace App\Form;

use App\Entity\Fiches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreerFicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    '6ème' => null,
                    '5ème' => null,
                    '4ème' => null,
                    '3ème' => null,
                    '2nd' => null,
                    'Première' => null,
                    'Terminale' => null,
                ]
            ])
            ->add('Discipline', ChoiceType::class, [
                'choices' => [
                    'Mathématique' => null,
                    'Français' => null,
                    'Histoire' => null,
                    'Géographie' => null,
                    'Physique' => null,
                    'Chimie' => null,
                    'SVT' => null,
                    'Arts' => null,
                    'Musique' => null,
                    'Sport' => null,
                ]
            ])
            ->add('Chapitre', TextType::class)
            ->add('nom', TextType::class, [
                'label' => 'Titre de la fiche',])
            ->add('concept_cle', TextareaType::class)
            ->add('Formules', TextareaType::class)
            ->add('A_retenir', TextareaType::class)
            ->add('Auteur', TextType::class)
            ->add('Enregistrer_en_brouillon', SubmitType::class)
            ->add('Publier', SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiches::class,
        ]);
    }
}
