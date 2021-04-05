<?php

namespace App\Form;

use App\Entity\Fiches;
use Symfony\Component\Form\AbstractType;
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
            ->add('niveau', TextType::class)
            ->add('Discipline', TextType::class)
            ->add('Chapitre', TextType::class)
            ->add('nom', TextType::class, [
                'label' => 'Titre de la fiche',])
            ->add('concept_cle', TextareaType::class)
            ->add('Formules', TextareaType::class)
            ->add('A_retenir', TextareaType::class)
            ->add('Auteur', TextType::class)
            ->add('Soumettre', SubmitType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiches::class,
        ]);
    }
}
