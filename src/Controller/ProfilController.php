<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfilController extends AbstractController
{
    /**
     * @Route("/afficher-profil", name="mon-profil")
     */
    public function afficherProfil() : Response
    {

        $profil= $this->getUser();

        return $this->render('profil/index.html.twig', [
            'profil' => $profil

        ]);
    }

     /**
     * @Route("/modifier-profil", name="modifier_profil",  methods={"GET","POST"})
     */
    public function modifier_profil(UserPasswordEncoderInterface $encoder, Request $request): Response
    {

        $profil= $this->getUser();

    if ($this->isGranted('ROLE_ADMIN')) 
    { 
        $form = $this->createFormBuilder($profil)

                
        
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
            'years' => range(2021,1900),
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
                'label' => 'Modifier votre profil'
            ])
            ->getForm();


        $form->handleRequest($request);
    }


    else
    {
        $form = $this->createFormBuilder($profil)

                
        
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
            'years' => range(2021,1900),
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

            ->add('submit', SubmitType::class, [
                'label' => 'Modifier votre profil'
            ])
            ->getForm();


        $form->handleRequest($request);
    }
                          
        if ($form->isSubmitted() && $form->isValid()) {
            $encodedPassword = $encoder->encodePassword($profil, $profil->getPassword());
            $profil->setPassword($encodedPassword);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mon-profil');
        }

        return $this->render('profil/modifier-profil.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    
    }
}
