<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfilController extends AbstractController
{
    /**
     * @Route("/afficher-profil/{id}", name="mon-profil")
     */
    public function AfficherProfil(User $profil): Response
    {

        return $this->render('profil/index.html.twig', [
            'profil' => $profil

        ]);
    }

     /**
     * @Route("/modifier-profil/{id}", name="modifier_profil",  methods={"GET","POST"})
     */
    public function modifier_profil(Request $request, User $profil): Response
    {

        if ($this->getUser() != $profil->getEmail()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createFormBuilder()

        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'constraints' => [
                new NotBlank(),
            ]
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prenom',
            'constraints' => [
                new NotBlank(),
            ]
        ])

        ->add('date_de_naissance', DateType::class, [
            'label' => 'Date de naissance',
            'constraints' => [
                new NotBlank(),
            ]
        ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 4
                    ])
                ]
            ])

            ->add('numen', IntegerType::class,[
                'label' => 'Veuillez indiquer votre NUMEN en tant que membre du corps enseignant'
                ])

            ->add('submit', SubmitType::class, [
                'label' => 'Créer un compte'
            ])
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('profil/modifier-profil.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    
    }
}
